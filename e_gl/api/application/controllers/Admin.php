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
					$dataUser = projectbase_query_block("select * from _report_user where username like '%".projectbase_post('query')."%' or name like '%".projectbase_post('query')."%' or no_ktp like '%".projectbase_post('query')."%' order by id desc LIMIT ".$page.",".$limit);
				}else{
					$dataUser = projectbase_query_block("select * from _report_user order by id desc LIMIT ".$page.",".$limit);
				}
				foreach($dataUser->result_array() as $item){
					$idd = $item['id'];
					// $idd = urlencode(xor_this($item['id']));
					array_push($dataUserArr,array(
						'_id' => $idd,
						// 'id_balik' => xor_this(urldecode($idd)),

						// PROFIL PENGGUNA
						'username' => $item['username'],
						'name' => $item['name'] == null ? '' : $item['name'],
						'gender' => $item['gender'] == null ? '' : $item['gender'],
						'religi_' => $item['religi_'] == null ? '' : $item['religi_'],
						'no_ktp' => $item['no_ktp'] == null ? '' : $item['no_ktp'],
						'npwp' => $item['npwp'] == null ? '' : $item['npwp'],
						'tmp_lahir' => $item['tmp_lahir'] == null ? '' : $item['tmp_lahir'],
						'tgl_lahir' => $item['tgl_lahir'] == null ? '' : $item['tgl_lahir'],
						'edu_' => $item['edu_'] == null ? '' : $item['edu_'],
						'phone_number' => $item['phone_number'] == null ? '' : $item['phone_number'],
						'email' => $item['email'] == null ? '' : $item['email'],
						'address' => $item['address'] == null ? '' : $item['address'],
						'provinsi_' => $item['provinsi_'] == null ? '' : $item['provinsi_'],
						'kab_kota_' => $item['kab_kota_'] == null ? '' : $item['kab_kota_'],

						// PROFIL USAHA
						'company' => $item['company'] == null ? '' : $item['company'],
						'alamat_usaha' => $item['alamat_usaha'] == null ? '' : $item['alamat_usaha'],
						'sektor_' => $item['sektor_'] == null ? '' : $item['sektor_'],
						'bidang_' => $item['bidang_'] == null ? '' : $item['bidang_'],
						'tgl_b_us' => $item['tgl_b_us'] == null ? '' : $item['tgl_b_us'],
						'iumkm' => $item['iumkm'] == null ? '' : $item['iumkm'],
						'npwp_usaha' => $item['npwp_usaha'] == null ? '' : $item['npwp_usaha'],
						'kaya_usaha' => $item['kaya_usaha'] == null ? '' : $item['kaya_usaha'],
						'volume_usaha' => $item['volume_usaha'] == null ? '' : $item['volume_usaha'],
						'emp_amount' => $item['emp_amount'] == null ? '' : $item['emp_amount'],
						'capacity' => $item['capacity'] == null ? '' : $item['capacity'],
						'koperasi' => $item['koperasi'] == null ? '' : $item['koperasi'] == 1 ? 'Ya' : 'Tidak',
						'latitude' => $item['latitude'] == null ? '' : $item['latitude'],
						'longitude' => $item['longitude'] == null ? '' : $item['longitude'],

						'enum_religi' => $item['enum_religi'] == null ? '' : $item['enum_religi'],
						'enum_edu' => $item['enum_edu'] == null ? '' : $item['enum_edu'],
						'enum_prov' => $item['enum_prov'] == null ? '' : $item['enum_prov'],
						'enum_city' => $item['enum_city'] == null ? '' : $item['enum_city'],
						'enum_sektor' => $item['enum_sektor'] == null ? '' : $item['enum_sektor'],
						'enum_bidang' => $item['enum_sektor'] == null ? '' : $item['enum_bidang']
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
				$getData = projectbase_jarvis_get_data('username','_report_user','id','asc','',array('id'=>$id));
				// $getData = projectbase_jarvis_get_data('username','_report_user','id','asc','',array('id'=>xor_this(urldecode($id))));
				foreach($getData['data'] as $item){ 
					// $idd = urlencode(xor_this($item['id']));
					$idd = $item['id'];
					array_push($getDataArr,array(
						'_id' => $idd,
						// PROFIL PENGGUNA
						'username' => $item['username'],
						'name' => $item['name'] == null ? '' : $item['name'],
						'gender' => $item['gender'] == null ? '' : $item['gender'],
						'religi_' => $item['religi_'] == null ? '' : $item['religi_'],
						'no_ktp' => $item['no_ktp'] == null ? '' : $item['no_ktp'],
						'npwp' => $item['npwp'] == null ? '' : $item['npwp'],
						'tmp_lahir' => $item['tmp_lahir'] == null ? '' : $item['tmp_lahir'],
						'tgl_lahir' => $item['tgl_lahir'] == null ? '' : $item['tgl_lahir'],
						'edu_' => $item['edu_'] == null ? '' : $item['edu_'],
						'phone_number' => $item['phone_number'] == null ? '' : $item['phone_number'],
						'email' => $item['email'] == null ? '' : $item['email'],
						'address' => $item['address'] == null ? '' : $item['address'],
						'provinsi_' => $item['provinsi_'] == null ? '' : $item['provinsi_'],
						'kab_kota_' => $item['kab_kota_'] == null ? '' : $item['kab_kota_'],

						// PROFIL USAHA
						'company' => $item['company'] == null ? '' : $item['company'],
						'alamat_usaha' => $item['alamat_usaha'] == null ? '' : $item['alamat_usaha'],
						'sektor_' => $item['sektor_'] == null ? '' : $item['sektor_'],
						'bidang_' => $item['bidang_'] == null ? '' : $item['bidang_'],
						'tgl_b_us' => $item['tgl_b_us'] == null ? '' : $item['tgl_b_us'],
						'iumkm' => $item['iumkm'] == null ? '' : $item['iumkm'],
						'npwp_usaha' => $item['npwp_usaha'] == null ? '' : $item['npwp_usaha'],
						'kaya_usaha' => $item['kaya_usaha'] == null ? '' : $item['kaya_usaha'],
						'volume_usaha' => $item['volume_usaha'] == null ? '' : $item['volume_usaha'],
						'emp_amount' => $item['emp_amount'] == null ? '' : $item['emp_amount'],
						'capacity' => $item['capacity'] == null ? '' : $item['capacity'],
						'koperasi' => $item['koperasi'] == null ? '' : $item['koperasi'] == 1 ? 'Ya' : 'Tidak',
						'latitude' => $item['latitude'] == null ? '' : $item['latitude'],
						'longitude' => $item['longitude'] == null ? '' : $item['longitude'],

						'enum_religi' => $item['enum_religi'] == null ? '' : $item['enum_religi'],
						'enum_edu' => $item['enum_edu'] == null ? '' : $item['enum_edu'],
						'enum_prov' => $item['enum_prov'] == null ? '' : $item['enum_prov'],
						'enum_city' => $item['enum_city'] == null ? '' : $item['enum_city'],
						'enum_sektor' => $item['enum_sektor'] == null ? '' : $item['enum_sektor'],
						'enum_bidang' => $item['enum_sektor'] == null ? '' : $item['enum_bidang']
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
			$idd = $id;
			// $idd = xor_this(urldecode($id));
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// $isUniqueUsername = false;
				// $isUniqueEmail = false;
				
				// $getUsername = projectbase_jarvis_get_data('username','jarvis_user','id','asc','',array('username'=>projectbase_post('username')));
				// if($getUsername['results'] != 0){
				// 	$isUniqueUsername = true;
				// }
				
				// $getEmail = projectbase_jarvis_get_data('email','jarvis_user','id','asc','',array('email'=>projectbase_post('email')));
				// if($getEmail['results'] != 0){
				// 	$isUniqueEmail = true;
				// }
				
				// if($isUniqueUsername == true && $isUniqueEmail == true){
				// 	echo json_encode(array('status'=>false,'message'=>'Username & Email already exists'));
				// }else if($isUniqueUsername == true && $isUniqueEmail == false){
				// 	echo json_encode(array('status'=>false,'message'=>'Username already exists'));
				// }else if($isUniqueEmail == true && $isUniqueUsername == false){
				// 	echo json_encode(array('status'=>false,'message'=>'Email already exists'));
				// }else{
					$data_update = array(
						// 'username'=>projectbase_post('username'),
						'company'=>projectbase_post('company'),
						'name'=>projectbase_post('name'),
						// 'email'=>projectbase_post('email'),
						'phone_number'=>projectbase_post('phone_number'),
						'address'=>projectbase_post('address'),
						'npwp'=>projectbase_post('npwp'),
						'no_ktp'=>projectbase_post('no_ktp'),
						'iumkm' => projectbase_post('iumkm'),
						'tgl_lahir'=>projectbase_post('tgl_lahir'),
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
					// Tambahan Profil Usaha
					$data_update['enum_sektor'] = projectbase_post('enum_sektor');
					$data_update['enum_bidang'] = projectbase_post('enum_bidang');
					$data_update['tgl_b_us'] = projectbase_post('tgl_b_us');
					$data_update['npwp_usaha'] = projectbase_post('npwp_usaha');
					$data_update['kaya_usaha'] = projectbase_post('kaya_usaha');
					$data_update['volume_usaha'] = projectbase_post('volume_usaha');
					$data_update['emp_amount'] = projectbase_post('emp_amount');
					$data_update['capacity'] = projectbase_post('capacity');
					$data_update['koperasi'] = projectbase_post('koperasi');				
					projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$idd);
					echo json_encode(array('status'=>true,'message'=>'Data updated'));
				// }				
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function update_password($id){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$idd = $id;
			// $idd = xor_this(urldecode($id));
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$password = md5(projectbase_post('password'));
				$data_update = array(
					'password'=>$password
				);					
				projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$idd);
				echo json_encode(array('status'=>true,'message'=>'Data updated'));
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
			$idd = $id;
			// $idd = xor_this(urldecode($id));
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
