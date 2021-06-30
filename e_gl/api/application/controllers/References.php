<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class References extends CI_Controller { 
	private $isActivied=array('1'=>array('ref_aktivasi'=>'true'),'2'=>array('c_status'=>'true'),'3'=>array('c_banned'=>'false'));
	function get_enum($fid){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		// $headers = apache_request_headers();
		$flag = array(
			"MeeZae5i"=>"pil_agama",
			"ja4oux6I"=>"pil_pendidikan",
			"azoh0Mee"=>"pil_sektor_usaha",
			"ve8ooKah"=>"pil_bidang_usaha",
		);
		$cacheData = get_redis($fid."_enume");
		if($cacheData == ''){
			$paramDataArr = array();
			$getData = projectbase_jarvis_get_data('parameter','jarvis_parameter','id','asc','',array('category_parameter'=>$flag[$fid],'status'=>'true'));
			foreach($getData['data'] as $item){ 
				array_push($paramDataArr,array(
					'id' => $item['id'],
					'parameter' => $item['parameter']
				));
			}
			save_redis($fid."_enume", json_encode($paramDataArr), 604800);
			echo json_encode($paramDataArr);
		}else{
			echo $cacheData;
		}
	}
	function get_provinsi(){
		$view='t_provinsi';
		$field_order='id_provinsi';
		$order_type='desc';
		$search_field='c_provinsi';
		$cacheData = get_redis("province_enume");
		if($cacheData == ''){
			$dataArr = array();
			$getData = projectbase_jarvis_get_data($search_field,$view,$field_order,$order_type,'',$this->isActivied[1]);
			foreach($getData['data'] as $item){ 
				array_push($dataArr,array(
					'id' => $item['id_provinsi'],
					'value' => $item['c_provinsi']
				));
			}
			save_redis("province_enume", json_encode($dataArr), 604800);
			echo json_encode($dataArr);
		}else{
			echo $cacheData;
		}
	}
	function get_kota($idprov){
		$view='t_kab_kota';
		$field_order='id_kota';
		$order_type='desc';
		$search_field='c_kab_kota';
		$cacheData = get_redis($idprov."_city_enume");
		if($cacheData == ''){
			$params_where=array('ref_provinsi'=>$idprov,'ref_aktivasi'=>'true');
			$dataArr = array();
			$getData = projectbase_jarvis_get_data($search_field,$view,$field_order,$order_type,'',$params_where);
			foreach($getData['data'] as $item){ 
				array_push($dataArr,array(
					'id' => $item['id_kota'],
					'value' => $item['c_kab_kota']
				));
			}
			save_redis($idprov."_city_enume", json_encode($dataArr), 604800);
			echo json_encode($dataArr);
		}else{
			echo $cacheData;
		}
	}
}
