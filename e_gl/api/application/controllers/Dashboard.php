<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller { 
    function get_gender(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $dataArr = array();
                $getData = projectbase_query_block("SELECT * FROM _dash_gender");
			    foreach($getData->result_array() as $item){
                    array_push($dataArr,array(
                        'id' => $item['gender'] == null ? '' : $item['gender'],
                        'value' => (int)$item['jumlah']
                    ));
                } 
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','data'=>$dataArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_religion(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $drArr = array();
                $getData = projectbase_query_block("SELECT * FROM _dash_religion");
			    foreach($getData->result_array() as $item){
                    $drArr[$item['enum_religi'] == null ? '' : $item['enum_religi']] = (int)$item['jumlah'];
                }

                $religiArr = array();
                $getReligi = projectbase_jarvis_get_data('parameter','jarvis_parameter','order_hint','asc','',array('category_parameter'=>'pil_agama','status'=>'true'));
                foreach($getReligi['data'] as $item){ 
                    array_push($religiArr,array(
                        'id' => $item['parameter'],
                        'value' => $drArr[$item['id']] == null ? 0 : $drArr[$item['id']]
                    ));
                }
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','results'=>count($religiArr),'data'=>$religiArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_education(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $drArr = array();
                $getData = projectbase_query_block("SELECT * FROM _dash_edu");
			    foreach($getData->result_array() as $item){
                    $drArr[$item['enum_edu'] == null ? '' : $item['enum_edu']] = (int)$item['jumlah'];
                }

                $eduArr = array();
                $getEdu = projectbase_jarvis_get_data('parameter','jarvis_parameter','order_hint','asc','',array('category_parameter'=>'pil_pendidikan','status'=>'true'));
                foreach($getEdu['data'] as $item){ 
                    array_push($eduArr,array(
                        'id' => $item['parameter'],
                        'value' => $drArr[$item['id']] == null ? 0 : $drArr[$item['id']]
                    ));
                }
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','results'=>count($eduArr),'data'=>$eduArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_province(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $drArr = array();
                $getData = projectbase_query_block("SELECT * FROM _dash_prov");
			    foreach($getData->result_array() as $item){
                    $drArr[$item['enum_prov'] == null ? '' : $item['enum_prov']] = (int)$item['jumlah'];
                }

                $provArr = array();
                $getProv = projectbase_jarvis_get_data('c_provinsi','t_provinsi','id_provinsi','asc','',array('ref_aktivasi'=>'true'));
                foreach($getProv['data'] as $item){ 
                    array_push($provArr,array(
                        'id' => $item['c_provinsi'],
                        'value' => $drArr[$item['id_provinsi']] == null ? 0 : $drArr[$item['id_provinsi']]
                    ));
                }
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','results'=>count($provArr),'data'=>$provArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_bidang_usaha(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $drArr = array();
                $getData = projectbase_query_block("SELECT * FROM _dash_bidang");
			    foreach($getData->result_array() as $item){
                    $drArr[$item['enum_bidang'] == null ? '' : $item['enum_bidang']] = (int)$item['jumlah'];
                }

                $bidangArr = array();
                $getBidang = projectbase_jarvis_get_data('parameter','jarvis_parameter','order_hint','asc','',array('category_parameter'=>'pil_bidang_usaha','status'=>'true'));
                foreach($getBidang['data'] as $item){ 
                    array_push($bidangArr,array(
                        'id' => $item['parameter'],
                        'value' => $drArr[$item['id']] == null ? 0 : $drArr[$item['id']]
                    ));
                }
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','results'=>count($bidangArr),'data'=>$bidangArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_uimk_summ(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $totalUser = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3'");
                $totalUserCount = $totalUser->num_rows() == 0 ? 0 : $totalUser->num_rows();
                $sudahPunya = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and iumkm != ''");
                $sudahPunyaCount = $sudahPunya->num_rows() == 0 ? 0 : $sudahPunya->num_rows();
                $dataArr = array('SUDAH'=>$sudahPunyaCount,'BELUM'=>($totalUserCount-$sudahPunyaCount),'TOTAL'=>$totalUserCount);
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','data'=>$dataArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_npwp_usaha(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $totalUser = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3'");
                $totalUserCount = $totalUser->num_rows() == 0 ? 0 : $totalUser->num_rows();
                $sudahPunya = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and npwp_usaha != ''");
                $sudahPunyaCount = $sudahPunya->num_rows() == 0 ? 0 : $sudahPunya->num_rows();
                $dataArr = array('SUDAH'=>$sudahPunyaCount,'BELUM'=>($totalUserCount-$sudahPunyaCount),'TOTAL'=>$totalUserCount);
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','data'=>$dataArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_koperasi(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $totalUser = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3'");
                $totalUserCount = $totalUser->num_rows() == 0 ? 0 : $totalUser->num_rows();
                $sudahPunya = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and koperasi = 1");
                $sudahPunyaCount = $sudahPunya->num_rows() == 0 ? 0 : $sudahPunya->num_rows();
                $dataArr = array('SUDAH'=>$sudahPunyaCount,'BELUM'=>($totalUserCount-$sudahPunyaCount),'TOTAL'=>$totalUserCount);
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','data'=>$dataArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
    function get_usaha_asset(){
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
                $totalUser = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3'");
                $totalUserCount = $totalUser->num_rows() == 0 ? 0 : $totalUser->num_rows();
                
                $kosong = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and kaya_usaha <= 0");
                $kosongCount = $kosong->num_rows() == 0 ? 0 : $kosong->num_rows();

                $mikro = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and kaya_usaha BETWEEN 1 and 1000000000");
                $mikroCount = $mikro->num_rows() == 0 ? 0 : $mikro->num_rows();
                
                $kecil = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and kaya_usaha BETWEEN 1000000000 and 5000000000");
                $kecilCount = $kecil->num_rows() == 0 ? 0 : $kecil->num_rows();

                $tengah = projectbase_query_block("SELECT id FROM `jarvis_user` where ref_group_user = 'J3' and kaya_usaha > 5000000000");
                $tengahCount = $tengah->num_rows() == 0 ? 0 : $tengah->num_rows();
                
                $dataArr = array(
                    'KOSONG'=>$kosongCount,
                    'MIKRO'=>$mikroCount,
                    'KECIL'=>$kecilCount,
                    'MENENGAH'=>$tengahCount,
                    'TOTAL'=>$totalUserCount
                );
                echo json_encode(array('success'=>true,'message_data'=>'Loaded data','data'=>$dataArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
    }
}