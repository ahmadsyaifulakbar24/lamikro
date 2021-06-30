<?php 
/* 
 * File:   QBclassc.php
 * Author: Aldian Eka Putra
 *
 * Created on October 1, 2013, 10:21 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QBclassc {
	//JSON
	//ExtJS Function
		// VIEW JSON
		function params_where($model,$params_where){
			$model->get_data_by_id($params_where);		
		}
		function search_view($model,$field_like){
			$model->parameter_search_model($field_like);		
		}
		function order_data_view($model,$field_sort,$type_sort){
			$model->order_by_data($field_sort,$type_sort);
		}
		function limit_data_view($model,$limit,$start){
			$model->limit_data($limit,$start);
		}
		function select_table_view($model,$table){
			$model->set_select_table($table);
		}
		function qb_json_view_process($model,$table,$field_like,$params_where='',$argsBlock=''){
			$query = $model->get_ref_table();
			$results = $model->row_data($table,$field_like,$params_where);
			$arr = array();
			$block_arg=$argsBlock;
			foreach ($query->result_array() as $obj){
				if($block_arg!=''){
					foreach($block_arg as $k => $v){
						$obj[$k]=$this->cvrt_fld($obj[$v['field']],$v['type']);
					}
				}
				$arr[] = $obj;
			}
			$output_view=array("success"=>true,"message"=>'Loaded data',"results"=>$results,"data"=>$arr);
			$json_output=json_encode($output_view);
			echo $json_output;
		}
		// CONVERT FIELD
		function cvrt_fld($field_to_convert,$field_type){
			$converted_field=$field_to_convert;
			if($field_type=="D"){
				$converted_field=($field_to_convert==''?'0000-00-00':date('Y-m-d', strtotime($field_to_convert)));
			}
			elseif($field_type=="P"){
				$converted_field=md5($field_to_convert);
			}
			elseif($field_type=="ENC"){
				$converted_field=base64_encode($field_to_convert);
			}
			elseif($field_type=="DEC"){
				$converted_field=base64_decode($field_to_convert);
			}
			elseif($field_type=="T"){
				$converted_field=date('H:i', strtotime($field_to_convert));
			}
			elseif($field_type=="KEY"){
				$converted_field=time();
			}
			elseif($field_type=="$"){
				$converted_field=str_replace('Rp ','',str_replace(',','',$field_to_convert));
			}
			elseif($field_type=="ENCRYPT"){
				$converted_field=projectbase_encode($field_to_convert);
			}
			elseif($field_type=="DECRYPT"){
				$converted_field=projectbase_decode($field_to_convert);
			}
			elseif($field_type=="HASH"){
				$converted_field=projectbase_hash_pass($field_to_convert);
			}
			elseif($field_type=="UCWORD"){
				$converted_field=ucwords(str_replace('_',' ',$field_to_convert));
			}
			elseif($field_type=="UID"){
				$converted_field=projectbase_session_get('logged_in','id');
			}
			elseif($field_type=="ID"){
				$converted_field=($field_to_convert==''?null:$field_to_convert);
			}
			elseif($field_type=="G_UID"){
				$converted_field=projectbase_session_get('logged_in','ref_group_user');
			}
			elseif($field_type=="NOW"){
				date_default_timezone_set("Asia/Bangkok");
				$converted_field=date("Y-m-d");
			}
			elseif($field_type=="jarvisDate"){
				$converted_field=date('d/m/Y', strtotime($field_to_convert));
			}
			elseif($field_type=="jarvisDateV2"){
				$x=explode('/',$field_to_convert);
				$converted_field=$x[2].'-'.$x[1].'-'.$x[0];
			}
			return $converted_field;
		}
		// ADD JSON
		function qb_json_add_process($httpdata, $root, $tbl, $fields, $fields_type, $fld_count, $fld_ori, $model,$ref_user){
			$records=$httpdata;
			$add_data=array();
			$j=1;
			while($j<=$fld_count){
				if ($fld_ori[$j]=='1'){
					$add_data[$fields[$j]]=$this->cvrt_fld($records[$fields[$j]],$fields_type[$j]);
				}
				$j++;
			}
			$model->save($tbl, $add_data);
			$this->qb_json_audit_trail_process($tbl,'INSERT',$model,$ref_user,'',$add_data);
		}
		// DELETE JSON
		function qb_json_delete_process($httpdata,$root,$tbl,$criteria,$model,$ref_user){
			$f_delete = $httpdata;
			$params=array($criteria=>$f_delete[$criteria]);
			$this->qb_json_audit_trail_process($tbl,'DELETE',$model,$ref_user,$params);
			$model->delete($tbl,$criteria,$f_delete[$criteria]);
		}
		// UPDATE JSON
		function qb_json_update_process($httpdata, $root, $tbl, $fields, $fields_type, $fld_count, $fld_ori, $criteria, $model, $ref_user){
			$savedata = $httpdata;
			$data = array();
			$j=1;
			while($j<=$fld_count){
				if ($fld_ori[$j]=='1'){
					$data[$fields[$j]]=$this->cvrt_fld($savedata[$fields[$j]],$fields_type[$j]);
				}
				$j++;
			}
			$params=array($criteria=>$savedata[$criteria]);
			$this->qb_json_audit_trail_process($tbl,'UPDATE',$model,$ref_user,$params,$data);
			$model->update($tbl,$criteria,$savedata[$criteria],$data);
		}
		// AUDIT TRAIL
		function qb_json_audit_trail_process($tbl,$jenis_change,$model,$ref_user,$params='',$data_array=''){
			if($jenis_change=='DELETE' or $jenis_change=='UPDATE' or $jenis_change=='LOGIN' or $jenis_change=='LOGOUT' or $jenis_change=='ACTIVITY'){
				$model->get_data_by_id($params);
				$this->select_table_view($model,$tbl);
				$query = $model->get_ref_table();
				$arr = array();
				foreach ($query->result_array() as $obj){
					$arr[] = $obj;
				}
			}else{
				if($jenis_change=='UPDATE' or $jenis_change=='LOGIN' or $jenis_change=='LOGOUT' or $jenis_change=='ACTIVITY'){
				}else{
					$arr=$data_array;
				}
			}
			if($jenis_change=='UPDATE' or $jenis_change=='LOGIN' or $jenis_change=='LOGOUT' or $jenis_change=='ACTIVITY'){
				$out_views=array("type"=>$jenis_change,"table"=>$tbl,"data_awal"=>$arr,"data_akhir"=>$data_array);
			}else{
				$out_views=array("type"=>$jenis_change,"table"=>$tbl,"data"=>$arr);
			}
			
			$output_view=$out_views;
			$action=json_encode($output_view);
			
			$data = array(	
				'ref_user' => $ref_user,
				'browser' => $_SERVER['HTTP_USER_AGENT'],
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'host' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
				'action' => $action,
				'data_name' => $tbl,
				'jenis_change' => $jenis_change,
			);
			$model->save('jarvis_audit_trail', $data);
		}
		//GET ONE ROW ONE FIELD
		function getSelectedDataByID($model,$params_where,$table,$get_field){
			$recieve_id_data='';
			$this->params_where($model,$params_where);
			$this->select_table_view($model,$table);
			$query = $model->get_ref_table();
			foreach ($query->result_array() as $obj){
				$recieve_id_data=$obj[$get_field];
			}
			return $recieve_id_data;
		}
		//GET ONE ROW
		function getSelectedDataByIDs($model,$params_where,$table){
			$recieve_id_data=array();
			$this->params_where($model,$params_where);
			$this->select_table_view($model,$table);
			$query = $model->get_ref_table();
			foreach ($query->result_array() as $obj){
				$recieve_id_data=$obj;
			}
			$output_view=array("success"=>true,"message"=>'Loaded data',"results"=>1,"data"=>$recieve_id_data);
			$json_output=json_encode($output_view);
			return $json_output;
		}
		// GET ROWS DATA
		function getNumsData($model,$params_where,$table){
			$recieve_id_data='';
			$this->params_where($model,$params_where);
			$this->select_table_view($model,$table);
			$query = $model->get_ref_table();
			$recieve_id_data=$query->num_rows();
			return $recieve_id_data;
		}
		// TRANSACTION JSON BLOK
		function qb_json_proses_blok($key_params,$model,$tbl,$data,$ref_user,$colname='',$pk='',$not_use_audit=''){
			if($key_params=='INSERT'){
				$params_criteria='';
				$model->save($tbl, $data);
			}elseif($key_params=='INSERT_BATCH'){
				$params_criteria='';
				$model->save_batch($tbl, $data);
			}elseif($key_params=='UPDATE' or $key_params=='LOGIN' or $key_params=='LOGOUT' or $key_params=='ACTIVITY'){
				$params_criteria=array($colname=>$pk);
				$model->update($tbl,$colname,$pk,$data);
			}elseif($key_params=='DELETE'){
				$params_criteria=array($colname=>$pk);
				$model->delete($tbl,$colname,$pk);
			}
			if($not_use_audit==true){			
			}else{
				$this->qb_json_audit_trail_process($tbl,$key_params,$model,$ref_user,$params_criteria,$data);
			}
		}
		// TREE NODE MENUS
		function qb_json_tree_node_menus($model,$table,$auth_index,$params_where=''){
			$arr = array();
			$query = $model->get_ref_table();
			foreach ($query->result_array() as $obj){
				$permission = $obj['permission'];
				$params_where_arr=array('pid'=>$obj['id'],'ref_type_menu'=>$params_where['ref_type_menu']);
				$model->get_data_by_id($params_where_arr);
				$this->select_table_view($model,$table);
				$query_num_rows = $model->get_ref_table();
				if ($query_num_rows->num_rows() > 0){
					// if have a child
					$obj['leaf'] = false;
					$obj['cls'] = 'folder';
				}else{
					// if have no child
					$obj['leaf'] = true;
					$obj['cls'] = 'file';
				}
				if($permission[$auth_index]=='0'){
					$arr[] = $obj;		
				}
			}
			$json_output=json_encode($arr);
			echo $json_output;
		}
		// MENU GROUP PERMISSION
		function qb_menu_group_permission($model,$auth_index){
			$auth_index=$auth_index;
			$group_access='';
			$menu_type=array();
			$data_access = array();
			$queryGroupMenu = $this->query_bloks($model,'select * from t_group_menu');
			foreach ($queryGroupMenu->result_array() as $group_menu){
				$menu_type[] = $group_menu['group_menu'];
			}
			foreach ($menu_type as $group_name) {
				$data_access[$group_name] = 'true';
			}
			foreach ($menu_type as $group_name) {
				$queryMenu = $this->query_bloks($model,"SELECT * FROM vw_tree_menu where group_menu = '".$group_name."'");
				foreach ($queryMenu->result_array() as $menu) {
					$permission = $menu['permission'];
					if($permission[$auth_index]=='0'){
						$data_access[$group_name] = 'false';
					}
				}
				$group_access .= 'var '.$group_name.'_access='.$data_access[$group_name].';';
			}
			return $group_access;
		}
		// BUTTON PERMISSION
		function qb_button_permission($model,$auth_index_val){
			$auth_index=$auth_index_val;
			$data_access='';
			$query = $model->get_ref_table();
			foreach ($query->result_array() as $obj){
				$permission_hide = $obj['permission_hide'];
				$permission_disable = $obj['permission_disable'];
				if($permission_hide[$auth_index]=='1'){
					$data_access .= 'var hide_'.str_replace('.','_',strtolower($obj['panel'])).'_'.$obj['item_id'].'=true;';
				}else{
					$data_access .= 'var hide_'.str_replace('.','_',strtolower($obj['panel'])).'_'.$obj['item_id'].'=false;';
				}
				
				if($permission_disable[$auth_index]=='1'){
					$data_access .= 'var disable_'.str_replace('.','_',strtolower($obj['panel'])).'_'.$obj['item_id'].'=true;';
				}else{
					$data_access .= 'var disable_'.str_replace('.','_',strtolower($obj['panel'])).'_'.$obj['item_id'].'=false;';
				}
			}
			return $data_access;
		}
		// JSON VIEW NOT IN
		function qb_json_view_process_not_in($model,$params){
			$this->select_table_view($model,$params['VIEW_ONE']['VIEW']);
			$model->get_data_by_id($params['VIEW_ONE']['WHERE']);
			$query_one = $model->get_ref_table();
			$arr_one = array();
			foreach ($query_one->result_array() as $obj){
				$arr_one[] = $obj[$params['VIEW_ONE']['OBJECT']['NOT_IN']];
			}
				$this->select_table_view($model,$params['VIEW_TWO']['VIEW']);
				if(!empty($arr_one)){
					$where_not_in = $model->where_no_in($params['VIEW_TWO']['FIELD_NOT_IN'],$arr_one);
					$where_no_in=array('FIELD'=>$params['VIEW_TWO']['FIELD_NOT_IN'],'VALUES'=>$arr_one);
					$this->search_view($model,$params['VIEW_TWO']['FIELD_LIKE']);
				}else{
					$where_no_in='';
					$this->search_view($model,$params['VIEW_TWO']['FIELD_LIKE']);
				}
				$this->order_data_view($model,$params['VIEW_TWO']['ORDER']['FIELD'],$params['VIEW_TWO']['ORDER']['TYPE']);
				if($params['VIEW_TWO']['WHERE']!=''){
					$model->get_data_by_id($params['VIEW_TWO']['WHERE']);
				}
				$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : $qbclassvar->get_variable('limit');
				if($_REQUEST['page']>0){ $start = ($_REQUEST['page']-1) * $limit;}else{$start = 0;}
				if(isset($params['VIEW_TWO']['LIMIT']) and $params['VIEW_TWO']['LIMIT']==true){
					$this->limit_data_view($model,$limit, $start);
				}
				$query_two = $model->get_ref_table();
				$results_two = $model->row_data($params['VIEW_TWO']['VIEW'],$params['VIEW_TWO']['FIELD_LIKE'],$params['VIEW_TWO']['WHERE'],$where_no_in);
				$arr_two = array();
				foreach ($query_two->result_array() as $obj){
					$arr_two[] = $obj;
				}
			$output_view=array("success"=>true,"message"=>'Loaded data',"results"=>$results_two,"data"=>$arr_two);
			$json_output=json_encode($output_view);
			echo $json_output;
		}
		// QUERY BLOCK
		function query_bloks($model,$query){
			return $model->query_bloks($query);
		}
		// NOTIFICATION
		function qb_notification($model,$file_data,$vw,$field_like,$params_where=''){
			$fp = fopen($file_data, 'w');		
			$query = $model->get_ref_table();
			$results = $model->row_data($vw,$field_like,$params_where);
			fwrite($fp, $results);
			fclose($fp);
		}
		// JARVIS VIEW PROCESS
		function jarvis_json_view_process($model,$table,$field_like,$params_where='',$argsBlock=''){
			$query = $model->get_ref_table();
			$results = $model->row_data($table,$field_like,$params_where);
			$arr = array();
			$block_arg=$argsBlock;
			foreach ($query->result_array() as $obj){
				if($block_arg!=''){
					foreach($block_arg as $k => $v){
						$obj[$k]=$this->cvrt_fld($obj[$v['field']],$v['type']);
					}
				}
				$arr[] = $obj;
			}
			$output_view=array("success"=>true,"message"=>'Loaded data',"results"=>$results,"data"=>$arr);
			return $output_view;
		}
		// POLRI STRUCTURE
		function qb_json_tree_polri($model,$table,$auth_index,$params_where=''){
			$arr = array();
			$query = $model->get_ref_table();
			foreach ($query->result_array() as $obj){
				$params_where_arr=array('pid'=>$obj['id']);
				$model->get_data_by_id($params_where_arr);
				$this->select_table_view($model,$table);
				$query_num_rows = $model->get_ref_table();
				if ($query_num_rows->num_rows() > 0){
					// if have a child
					$obj['leaf'] = false;
					$obj['cls'] = 'folder';
				}else{
					// if have no child
					$obj['leaf'] = true;
					$obj['cls'] = 'file';
				}	
				$arr[] = $obj;		
			}
			$json_output=json_encode($arr);
			echo $json_output;
		}
}
