<?php 
/* 
 * File:   QBclassm.php
 * Author: Aldian Eka Putra
 *
 * Created on October 1, 2013, 11:21 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QBclassm {
	function json_get_data($qbclassc,$qbclassvar,$qbmodel,$search_field,$vw,$order_field,$order_type,$get_limit='',$params_where='',$argsBlock=''){	
		$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : $qbclassvar->get_variable('limit');
		if($_REQUEST['page']>0){ $start = ($_REQUEST['page']-1) * $limit;}else{$start = 0;}
		if(!empty($params_where)){
			$qbmodel->get_data_by_id($params_where);
		}
		$qbclassc->search_view($qbmodel,$qbclassvar->get_variable('col_searched',$search_field));
		if($get_limit==true){
			$qbclassc->limit_data_view($qbmodel,$limit, $start);
		}
		$qbclassc->select_table_view($qbmodel,$qbclassvar->get_variable('vw',$vw));
        $qbclassc->order_data_view($qbmodel,$qbclassvar->get_variable('tbl_fields',$order_field), $qbclassvar->get_variable('order_type',$order_type));
        $qbclassc->qb_json_view_process($qbmodel,$qbclassvar->get_variable('vw',$vw), $qbclassvar->get_variable('col_searched',$search_field),$params_where,$argsBlock);
    }
	function json_save_data($qbclassc,$qbclassvar,$qbmodel,$tabel,$record_saved_get,$fld_type,$fld_count,$fld_ori,$ref_user){
		$data = json_decode(file_get_contents("php://input"),true);
		$record_saved=$record_saved_get;
		$qbclassc->qb_json_add_process(
			$data, 
			$qbclassvar->get_variable('json_root'),
			$qbclassvar->get_variable('tbl',$tabel),
			$qbclassvar->get_variable('tbl_fields',$record_saved), 
			$fld_type,
			$fld_count,
			$fld_ori,
			$qbmodel,
			$ref_user
		);
	}
	function json_update($qbclassc,$qbclassvar,$qbmodel,$record_updated,$tbl,$fld_type,$fld_count,$fld_ori,$field_pk,$ref_user){
		$data = json_decode(file_get_contents("php://input"),true);
		$record_saved=$record_updated;
		$qbclassc->qb_json_update_process(
			$data,
			$qbclassvar->get_variable('json_root'),
			$qbclassvar->get_variable('tbl',$tbl),
			$qbclassvar->get_variable('tbl_fields',$record_saved),
			$fld_type,
			$fld_count,
			$fld_ori,
			$field_pk,
			$qbmodel,
			$ref_user
		);
	}
	function json_delete_data($lib_clas,$class_var,$model,$table,$field_pk,$ref_user){
		$data = json_decode(file_get_contents("php://input"),true);
		$lib_clas->qb_json_delete_process(
			$data,
			$class_var->get_variable('json_root'),
			$class_var->get_variable('tbl',$table),
			$field_pk,
			$model,
			$ref_user
		); 
	}
	function getSelectedDataByIDm($qbclassc,$model,$params_where,$table,$get_field){
		return $qbclassc->getSelectedDataByID($model,$params_where,$table,$get_field);
	}
	function getSelectedDataByIDsm($qbclassc,$model,$params_where,$table){
		return $qbclassc->getSelectedDataByIDs($model,$params_where,$table);
	}
	function getNumsDataIDM($qbclassc,$model,$params_where,$table){
		return $qbclassc->getNumsData($model,$params_where,$table);
	}
	function json_get_tree_node($qbclassc,$qbclassvar,$qbmodel,$vw,$order_field,$order_type,$auth_index,$params_where=''){	
		if(!empty($params_where)){
			$qbmodel->get_data_by_id($params_where);
		}
		$qbclassc->select_table_view($qbmodel,$qbclassvar->get_variable('vw',$vw));
        $qbclassc->order_data_view($qbmodel,$qbclassvar->get_variable('tbl_fields',$order_field), $qbclassvar->get_variable('order_type',$order_type));
        $qbclassc->qb_json_tree_node_menus($qbmodel,$qbclassvar->get_variable('vw',$vw),$auth_index,$params_where);
    }
    function js_button_permission($qbclassc,$qbclassvar,$qbmodel,$vw,$auth_index){
		$qbclassc->select_table_view($qbmodel,$qbclassvar->get_variable('vw',$vw));
		return $qbclassc->qb_button_permission($qbmodel,$auth_index);
	}
	function json_get_data_not_in($qbclassc,$qbclassvar,$qbmodel,$params){	
        $qbclassc->qb_json_view_process_not_in($qbmodel,$params);
    }
    function js_notification($qbclassc,$qbclassvar,$qbmodel,$vw,$file_data,$field_like,$params_where=''){
		$qbclassc->select_table_view($qbmodel,$qbclassvar->get_variable('vw',$vw));
		$qbclassc->qb_notification($qbmodel,$file_data,$vw,$field_like,$params_where);
	}
	function checkEmail($email) {
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
		  return true;
		} else {
		  return false;
		}
	}
	function jarvis_get_data($jarvisclassc,$jarvisclassvar,$jarvismodel,$search_field,$vw,$order_field,$order_type,$get_limit='',$params_where='',$argsBlock=''){	
		$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : $jarvisclassvar->get_variable('limit');
		if(isset($_REQUEST['page']) and $_REQUEST['page']>0){ $start = ($_REQUEST['page']-1) * $limit;}else{$start = 0;}
		if(!empty($params_where)){
			$jarvismodel->get_data_by_id($params_where);
		}
		$jarvisclassc->search_view($jarvismodel,$jarvisclassvar->get_variable('col_searched',$search_field));
		if($get_limit==true){
			$jarvisclassc->limit_data_view($jarvismodel,$limit, $start);
		}
		$jarvisclassc->select_table_view($jarvismodel,$jarvisclassvar->get_variable('vw',$vw));
        $jarvisclassc->order_data_view($jarvismodel,$jarvisclassvar->get_variable('tbl_fields',$order_field), $jarvisclassvar->get_variable('order_type',$order_type));
        return $jarvisclassc->jarvis_json_view_process($jarvismodel,$jarvisclassvar->get_variable('vw',$vw), $jarvisclassvar->get_variable('col_searched',$search_field),$params_where,$argsBlock);
    }
    function jarvis_call_configuration($qbclassc,$qbmodel,$key){
		$params_config=array('key'=>$key);
		return $this->getSelectedDataByIDm($qbclassc,$qbmodel,$params_config,'configuration','value');	
	}
	function jarvis_check_activity($qbclassc,$qbmodel,$id_session){
		date_default_timezone_set("Asia/Bangkok"); 
		$qbclassc->qb_json_proses_blok('ACTIVITY',$qbmodel,'t_user',array('last_activity'=>date("Y-m-d H:i:s"),'last_time_activity'=>time()*1000),$id_session,'id',$id_session,true);
	}
	function json_get_tree_polri($qbclassc,$qbclassvar,$qbmodel,$vw,$order_field,$order_type,$auth_index,$params_where=''){	
		if(!empty($params_where)){
			$qbmodel->get_data_by_id($params_where);
		}
		$qbclassc->select_table_view($qbmodel,$qbclassvar->get_variable('vw',$vw));
        $qbclassc->order_data_view($qbmodel,$qbclassvar->get_variable('tbl_fields',$order_field), $qbclassvar->get_variable('order_type',$order_type));
        $qbclassc->qb_json_tree_polri($qbmodel,$qbclassvar->get_variable('vw',$vw),$auth_index,$params_where);
    }
}
