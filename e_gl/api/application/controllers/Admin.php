<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller { 
	function get_all(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$dataUserArr = array();
				$limit = projectbase_post('limitPage');
				$page = (projectbase_post('page')-1)*$limit;
				if(projectbase_post('query') !=''){
					$dataUser = projectbase_query_block("select * from jarvis_user order by id desc LIMIT ".$page.",".$limit);
				}else{
					$dataUser = projectbase_query_block("select * from jarvis_user order by id desc LIMIT ".$page.",".$limit);
				}
				foreach($dataUser->result_array() as $item){
					$idd = urlencode(xor_this($item['id']));
					array_push($dataUserArr,array(
						'_id' => $idd,
						// 'id_balik' => xor_this(urldecode($idd)),
						'username' => $item['username'],
						'company' => $item['company'] == null ? '' : $item['company'],
						'name' => $item['name'] == null ? '' : $item['name'],
						'email' => $item['email'] == null ? '' : $item['email'],
						'phone_number' => $item['phone_number'] == null ? '' : $item['phone_number'],
						'address' => $item['address'] == null ? '' : $item['address'],
						'iumkm' => $item['iumkm'] == null ? '' : $item['iumkm'],
						'npwp' => $item['npwp'] == null ? '' : $item['npwp'],
						'no_ktp' => $item['no_ktp'] == null ? '' : $item['no_ktp'],
						'gender' => $item['gender'] == null ? '' : $item['gender'],
						// 'tgl_lahir' => $item['tgl_lahir'],
						'latitude' => $item['latitude'] == null ? '' : $item['latitude'],
						'longitude' => $item['longitude'] == null ? '' : $item['longitude'],
						'alamat_usaha' => $item['alamat_usaha'] == null ? '' : $item['alamat_usaha']
					));
				}
				echo json_encode(array('success'=>true,'message_data'=>'Loaded data','results'=>count($dataUserArr),'data'=>$dataUserArr));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function get_one($id){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$getDataArr = array();
				$result = json_decode($data, true);
				$getData = projectbase_jarvis_get_data('username','jarvis_vw_user','id','asc','',array('id'=>xor_this(urldecode($id))));
				foreach($getData['data'] as $item){ 
					$idd = urlencode(xor_this($item['id']));
					array_push($getDataArr,array(
						'_id' => $idd,
						'username' => $item['username'],
						'PERUSAHAAN' => $item['company'] == null ? '' : $item['company'],
						'NAMA' => $item['name'] == null ? '' : $item['name'],
						'EMAIL' => $item['email'] == null ? '' : $item['email'],
						'phone_number' => $item['phone_number'] == null ? '' : $item['phone_number'],
						'ALAMAT_TINGGAL' => $item['address'] == null ? '' : $item['address'],
						'IUMKM' => $item['iumkm'] == null ? '' : $item['iumkm'],
						'NPWP_PRIBADI' => $item['npwp'] == null ? '' : $item['npwp'],
						'KTP' => $item['no_ktp'] == null ? '' : $item['no_ktp'],
						// 'TGL-LAHIR' => $item['tgl_lahir'] == null ? '' : $item['tgl_lahir'],
						'GENDER' => $item['gender'] == null ? '' : $item['gender'],
						'LAT' => $item['latitude'] == null ? '' : $item['latitude'],
						'LON' => $item['longitude'] == null ? '' : $item['longitude'],
						'ALAMAT-USAHA' => $item['alamat_usaha'] == null ? '' : $item['alamat_usaha'],
						// 'religion' => '',
						// 'education' => '',
						// 'province' => '',
						// 'city' => ''
					));
				}
				echo json_encode($getDataArr);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function update_user($id){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$idd = xor_this(urldecode($id));
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$isUniqueUsername = false;
				$isUniqueEmail = false;
				
				$getUsername = projectbase_jarvis_get_data('username','jarvis_user','id','asc','',array('username'=>projectbase_post('username')));
				if($getUsername['results'] != 0){
					$isUniqueUsername = true;
				}
				
				$getEmail = projectbase_jarvis_get_data('email','jarvis_user','id','asc','',array('email'=>projectbase_post('email')));
				if($getEmail['results'] != 0){
					$isUniqueEmail = true;
				}
				
				if($isUniqueUsername == true && $isUniqueEmail == true){
					echo json_encode(array('status'=>false,'message'=>'Username & Email already exists'));
				}else if($isUniqueUsername == true && $isUniqueEmail == false){
					echo json_encode(array('status'=>false,'message'=>'Username already exists'));
				}else if($isUniqueEmail == true && $isUniqueUsername == false){
					echo json_encode(array('status'=>false,'message'=>'Email already exists'));
				}else{
					$data_update = array(
						'username'=>projectbase_post('username'),
						'company'=>projectbase_post('company'),
						'name'=>projectbase_post('name'),
						'email'=>projectbase_post('email'),
						'phone_number'=>projectbase_post('phone_number'),
						'address'=>projectbase_post('address'),
						'npwp'=>projectbase_post('npwp'),
						'no_ktp'=>projectbase_post('no_ktp'),
						'iumkm' => projectbase_post('iumkm'),
						// 'tgl_lahir'=>projectbase_post('tgl_lahir'),
						'gender'=>projectbase_post('gender'),
						'latitude' => projectbase_post('latitude'),
						'longitude' => projectbase_post('longitude'),
						'alamat_usaha' => projectbase_post('alamat_usaha')
					);
					// Tambahan Profile Pengguna
					$data_update['enum_religi'] = projectbase_post('enum_religi');
					$data_update['tmp_lahir'] = projectbase_post('tmp_lahir');
					$data_update['enum_edu'] = projectbase_post('enum_edu');
					$data_update['enum_prov'] = projectbase_post('enum_prov');
					$data_update['enum_city'] = projectbase_post('enum_city');					
					projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$idd);
					echo json_encode(array('status'=>true,'message'=>'Data updated'));
				}				
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function delete_user($id){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$idd = xor_this(urldecode($id));
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				projectbase_process_block('DELETE','jarvis_user','',$result['userdata']['id'],'id',$idd);
				echo json_encode(array('status'=>true,'message'=>'Data deleted'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
}
