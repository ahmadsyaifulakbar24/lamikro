<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services extends CI_Controller { 
	function oauth(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
        $username = projectbase_post('username');
        $password = projectbase_post('password');
        $result = projectbase_jarvis_get_data('username','jarvis_vw_user','id','asc','',array('username'=>$username,'password'=>md5($password)));
        // $this->load->driver('cache');
		// $this->cache->file->save('Aldian', 'Putra', 604800);
		if($result['results']==1){
			$sess_array = array();
			foreach($result['data'] as $row){
				if($row['banned']=='true'){
					echo json_encode(array('status'=>false,'message'=>'Username is banned'));
				}else{
					$token = random_string('md5');
					$id = $row['id'];
					date_default_timezone_set("Asia/Bangkok");
					$data = array(
						'last_activity'=>date("Y-m-d H:i:s"),
						'last_time_activity'=>time()*1000,
						'last_login'=>date("Y-m-d H:i:s"),
						'is_online'=>'true',
					);
					projectbase_process_block('LOGIN','jarvis_user',$data,$id,'id',$id);
					if($row['ref_group_user'] == 'J3'){
						$accountNameArr = array();
						$accountName = projectbase_jarvis_get_data('acc_name','adm_vw_account_name','acc_code','asc','',array('user_id'=>$id,'active'=>'yes'));
						foreach($accountName['data'] as $item){ 
							array_push($accountNameArr,array(
								'id' => $item['id'],
								'acc_code' => $item['acc_code'],
								'acc_name' => $item['acc_name'],
								'pemasukan' => $item['pemasukan'],
								'pengeluaran' => $item['pengeluaran'],
								'hutang' => $item['hutang'],
								'bayar_hutang' => $item['bayar_hutang'],
								'piutang' => $item['piutang'],
								'dibayar_piutang' => $item['dibayar_piutang'],
								'tambah_modal' => $item['tambah_modal'],
								'tarik_modal' => $item['tarik_modal'],
								'pengalihan_aset' => $item['pengalihan_aset'],
								'group_id' => $item['group_id'],
								'acc_group_name' => $item['acc_group_name'],
								'profit_n_loss' => $item['profit_n_loss'],
								'section_id' => $item['section_id'],
								'section_name' => $item['section_name']
							));
						}
						$sess_array = array(
							'userdata' => array(
								'id' => $id, 
								'username' => $row['username'], 
								'name' => $row['name'], 
								'email' => $row['email'], 
								'tgl_lahir' => $row['tgl_lahir'], 
								'gender' => $row['gender'], 
								'phone_number' => $row['phone_number'], 
								'address' => $row['address'], 
								'no_ktp' => $row['no_ktp'],
								'npwp' => $row['npwp'],
								'avatar' => $row['avatar'], 
								'ref_group_user' => $row['ref_group_user'], 
								'group' => $row['group'], 
								'company' => $row['company'], 
								'iumkm' => $row['iumkm'], 
								'jenis_usaha' => $row['jenis_usaha'], 
								'alamat_usaha' => $row['alamat_usaha']
							),
							'accountname' => $accountNameArr
						);
						// Tambahan Profile Pengguna
						$sess_array['userdata']['enum_religi'] = $row['enum_religi'];
						$sess_array['userdata']['tmp_lahir'] = $row['tmp_lahir'];
						$sess_array['userdata']['enum_edu'] = $row['enum_edu'];
						$sess_array['userdata']['enum_prov'] = $row['enum_prov'];
						$sess_array['userdata']['enum_city'] = $row['enum_city'];
						$sess_array['userdata']['enum_sektor'] = $row['enum_sektor'];
						$sess_array['userdata']['enum_bidang'] = $row['enum_bidang'];
						$sess_array['userdata']['tgl_b_us'] = $row['tgl_b_us'];
						$sess_array['userdata']['npwp_usaha'] = $row['npwp_usaha'];
						$sess_array['userdata']['kaya_usaha'] = $row['kaya_usaha'];
						$sess_array['userdata']['volume_usaha'] = $row['volume_usaha'];
						$sess_array['userdata']['emp_amount'] = $row['emp_amount'];
						$sess_array['userdata']['capacity'] = $row['capacity'];
						$sess_array['userdata']['koperasi'] = $row['koperasi'];
					}else{
						$sess_array = array(
							'userdata' => array(
								'id' => $id, 
								'username' => $row['username'], 
								'name' => $row['name'], 
								'email' => $row['email'], 
								'ref_group_user' => $row['ref_group_user'], 
								'group' => $row['group']
							)
						);
					}
                    save_redis($token, json_encode($sess_array), 604800);
                    save_redis($token.'-password', md5($password), 604800);
                    echo json_encode(array('status'=>true,'message'=>$token));
				}		
			}
		}else{
            echo json_encode(array('status'=>false,'message'=>'Invalid username or password'));
		}
	}
	function register(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");

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
			$data_insert = array(
				'name'=>projectbase_post('fullname'),
				'company'=>projectbase_post('company'),
				'alamat_usaha'=>projectbase_post('address'),
				'iumkm'=>projectbase_post('iumkm'),
				'npwp'=>projectbase_post('npwp'),
				'no_ktp'=>projectbase_post('nik'),
				'email'=>projectbase_post('email'),
				'phone_number'=>projectbase_post('no_hp'),
				'username'=>projectbase_post('username'),
				'password'=>md5(projectbase_post('password')),
				'ref_group_user'=>'J3',
			);
			$registerUser = projectbase_process_block('INSERT','jarvis_user',$data_insert,'1');
			
			$getRegisterUser = projectbase_jarvis_get_data('email','jarvis_user','id','asc','',array('email'=>projectbase_post('email')));
			$accName = projectbase_jarvis_get_data('acc_name','mst_account_name','id','asc','');	
			$dataAccInsert = array();	
			foreach($accName['data'] as $item){
				array_push($dataAccInsert,
					array(
						'user_id'=>$getRegisterUser['data'][0]['id'],
						'acc_code'=>$item['acc_code'],
						'acc_name'=>$item['acc_name'],
						'group_id'=>$item['group_id'],
						'active'=>$item['active'],
						'pemasukan'=>$item['pemasukan'],
						'pengeluaran'=>$item['pengeluaran'],
						'hutang'=>$item['hutang'],
						'bayar_hutang'=>$item['bayar_hutang'],
						'piutang'=>$item['piutang'],
						'dibayar_piutang'=>$item['dibayar_piutang'],
						'tambah_modal'=>$item['tambah_modal'],
						'tarik_modal'=>$item['tarik_modal'],
						'pengalihan_aset'=>$item['pengalihan_aset']
					)
				);
			}
			$registerAccount = projectbase_process_block('INSERT_BATCH','adm_account_name',$dataAccInsert,$getRegisterUser['data'][0]['id']);
			echo json_encode(array('status'=>true,'message'=>'Register success'));
		}
	}
    function metadata($type){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				echo json_encode($result[$type]);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function jenisUsaha(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$cacheData = get_redis('jenisUsaha');
				if($cacheData == ''){
					$paramDataArr = array();
					$transTypeData = projectbase_jarvis_get_data('parameter','jarvis_parameter','id','asc','',array('category_parameter'=>'jenis_usaha','status'=>'true'));
					foreach($transTypeData['data'] as $item){ 
						array_push($paramDataArr,array(
							'id' => $item['id'],
							'parameter' => $item['parameter']
						));
					}
					save_redis('jenisUsaha', json_encode($paramDataArr), 604800);
					echo json_encode($paramDataArr);
				}else{
					echo $cacheData;
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function updateProfile(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$isUniqueUsername = false;
				$isUniqueEmail = false;
				
				if(projectbase_post('username') != $result['userdata']['username']){
					$getUsername = projectbase_jarvis_get_data('username','jarvis_user','id','asc','',array('username'=>projectbase_post('username')));
					if($getUsername['results'] != 0){
						$isUniqueUsername = true;
					}
				}
				
				if(projectbase_post('email') != $result['userdata']['email']){
					$getEmail = projectbase_jarvis_get_data('email','jarvis_user','id','asc','',array('email'=>projectbase_post('email')));
					if($getEmail['results'] != 0){
						$isUniqueEmail = true;
					}
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
						'name'=>projectbase_post('name'),
						'email'=>projectbase_post('email'),
						'phone_number'=>projectbase_post('phone_number'),
						'address'=>projectbase_post('address'),
						'npwp'=>projectbase_post('npwp'),
						'no_ktp'=>projectbase_post('no_ktp'),
						'tgl_lahir'=>projectbase_post('tgl_lahir'),
						'gender'=>projectbase_post('gender')
					);
					// Tambahan Profile Pengguna
					$data_update['enum_religi'] = projectbase_post('enum_religi');
					$data_update['tmp_lahir'] = projectbase_post('tmp_lahir');
					$data_update['enum_edu'] = projectbase_post('enum_edu');
					$data_update['enum_prov'] = projectbase_post('enum_prov');
					$data_update['enum_city'] = projectbase_post('enum_city');					
					projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$result['userdata']['id']);
					$sess_array = array(
						'userdata' => array(
							'id' => $result['userdata']['id'], 
							'username' => projectbase_post('username'), 
							'name' => projectbase_post('name'), 
							'email' => projectbase_post('email'), 
							'tgl_lahir' => projectbase_post('tgl_lahir'), 
							'gender' => projectbase_post('gender'), 
							'phone_number' => projectbase_post('phone_number'), 
							'address' => projectbase_post('address'), 
							'no_ktp' => projectbase_post('no_ktp'),
							'npwp' => projectbase_post('npwp'), 
							'avatar' => $result['userdata']['avatar'], 
							'ref_group_user' => $result['userdata']['ref_group_user'], 
							'group' => $result['userdata']['group'],
							'company' => $result['userdata']['company'], 
							'iumkm' => $result['userdata']['iumkm'], 
							'jenis_usaha' => $result['userdata']['jenis_usaha'], 
							'alamat_usaha' => $result['userdata']['alamat_usaha'] 
						),
						'accountname' => $result['accountname']
					);
					// Tambahan Profile Pengguna (Session)
					$sess_array['userdata']['enum_religi'] = projectbase_post('enum_religi');
					$sess_array['userdata']['tmp_lahir'] = projectbase_post('tmp_lahir');
					$sess_array['userdata']['enum_edu'] = projectbase_post('enum_edu');
					$sess_array['userdata']['enum_prov'] = projectbase_post('enum_prov');
					$sess_array['userdata']['enum_city'] = projectbase_post('enum_city');
					// Tambahan Profile Pengguna (Session)
					$sess_array['userdata']['enum_sektor'] = $result['userdata']['jenis_usaha'];
					$sess_array['userdata']['enum_bidang'] = $result['userdata']['enum_bidang'];
					$sess_array['userdata']['tgl_b_us'] = $result['userdata']['tgl_b_us'];
					$sess_array['userdata']['npwp_usaha'] = $result['userdata']['npwp_usaha'];
					$sess_array['userdata']['kaya_usaha'] = $result['userdata']['kaya_usaha'];
					$sess_array['userdata']['volume_usaha'] = $result['userdata']['volume_usaha'];
					$sess_array['userdata']['emp_amount'] = $result['userdata']['emp_amount'];
					$sess_array['userdata']['capacity'] = $result['userdata']['capacity'];
					$sess_array['userdata']['koperasi'] = $result['userdata']['koperasi'];
					save_redis($headers['token-id'], json_encode($sess_array), 604800);
					echo json_encode(array('status'=>true,'message'=>'Data updated'));
				}
				
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function updateProfileUsaha(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);				
					$data_update = array(
						'company'=>projectbase_post('company'),
						'iumkm'=>projectbase_post('iumkm'),
						'jenis_usaha'=>projectbase_post('jenis_usaha'),
						'alamat_usaha'=>projectbase_post('alamat_usaha')
					);
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
					projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$result['userdata']['id']);
					$sess_array = array(
						'userdata' => array(
							'id' => $result['userdata']['id'], 
							'username' => $result['userdata']['username'], 
							'name' => $result['userdata']['name'], 
							'email' => $result['userdata']['email'], 
							'tgl_lahir' => $result['userdata']['tgl_lahir'], 
							'gender' => $result['userdata']['gender'], 
							'phone_number' => $result['userdata']['phone_number'], 
							'address' => $result['userdata']['address'], 
							'no_ktp' => $result['userdata']['no_ktp'],
							'npwp' => $result['userdata']['npwp'], 
							'avatar' => $result['userdata']['avatar'], 
							'ref_group_user' => $result['userdata']['ref_group_user'], 
							'group' => $result['userdata']['group'],
							'company' => projectbase_post('company'), 
							'iumkm' => projectbase_post('iumkm'), 
							// 'jenis_usaha' => projectbase_post('jenis_usaha'), 
							'alamat_usaha' => projectbase_post('alamat_usaha') 
						),
						'accountname' => $result['accountname']
					);
					// Tambahan Profile Pengguna (Session)
					$sess_array['userdata']['enum_religi'] = $result['userdata']['enum_religi'];
					$sess_array['userdata']['tmp_lahir'] = $result['userdata']['tmp_lahir'];
					$sess_array['userdata']['enum_edu'] = $result['userdata']['enum_edu'];
					$sess_array['userdata']['enum_prov'] = $result['userdata']['enum_prov'];
					$sess_array['userdata']['enum_city'] = $result['userdata']['enum_city'];
					// Tambahan Profile Pengguna (Session)
					$sess_array['userdata']['enum_sektor'] = projectbase_post('enum_sektor');
					$sess_array['userdata']['enum_bidang'] = projectbase_post('enum_bidang');
					$sess_array['userdata']['tgl_b_us'] = projectbase_post('tgl_b_us');
					$sess_array['userdata']['npwp_usaha'] = projectbase_post('npwp_usaha');
					$sess_array['userdata']['kaya_usaha'] = projectbase_post('kaya_usaha');
					$sess_array['userdata']['volume_usaha'] = projectbase_post('volume_usaha');
					$sess_array['userdata']['emp_amount'] = projectbase_post('emp_amount');
					$sess_array['userdata']['capacity'] = projectbase_post('capacity');
					$sess_array['userdata']['koperasi'] = projectbase_post('koperasi');
					save_redis($headers['token-id'], json_encode($sess_array), 604800);
					echo json_encode(array('status'=>true,'message'=>'Data updated'));
				
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function changePassword(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$dataPass = get_redis($headers['token-id'].'-password');
				$oldPassword = md5(projectbase_post('oldpassword'));
				$password = md5(projectbase_post('password'));
				if($dataPass == $oldPassword){
					$data_update = array(
						'password'=>$password
					);
					projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$result['userdata']['id']);
					save_redis($headers['token-id'].'-password', $password, 604800);
					echo json_encode(array('status'=>true,'message'=>'Data updated'));
				}else{
					echo json_encode(array('status'=>false,'message'=>'Current password invalid'));
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function logout(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				delete_redis($headers['token-id']);
				delete_redis($headers['token-id'].'-password');
				echo json_encode(array('status'=>true,'message'=>'Youre logout'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function transType(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$cacheData = get_redis($headers['token-id'].'-transType');
				if($cacheData == ''){
					$paramDataArr = array();
					$transTypeData = projectbase_jarvis_get_data('parameter','jarvis_parameter','id','asc','',array('category_parameter'=>'trans_category','status'=>'true'));
					foreach($transTypeData['data'] as $item){ 
						array_push($paramDataArr,array(
							'id' => $item['id'],
							'parameter' => $item['parameter']
						));
					}
					save_redis($headers['token-id'].'-transType', json_encode($paramDataArr), 3600);
					echo json_encode($paramDataArr);
				}else{
					echo $cacheData;
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function kreditDebitAccountCombo($id){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$accountKreditArr = array();
				$accountDebitArr = array();
				if($id == 215){
					foreach($result['accountname'] as $item){
						array_push($accountKreditArr,array(
							'id'=>'K.'.$item['id'],
							'acc_code'=>$item['acc_code'],
							'acc_name'=>$item['acc_name']
						));
						array_push($accountDebitArr,array(
							'id'=>'D.'.$item['id'],
							'acc_code'=>$item['acc_code'],
							'acc_name'=>$item['acc_name']
						));
					}
					echo json_encode(array('label'=>jurnalEntryLabel($id),'data'=>array('kredit'=>$accountKreditArr,'debit'=>$accountDebitArr)));
				}else{
					$listAccountKredit = accountNameFilter2($result['accountname'],comboTypeAccount($id),'K');
					$listAccountDebit = accountNameFilter2($result['accountname'],comboTypeAccount($id),'D');
					foreach($listAccountKredit as $item){
						array_push($accountKreditArr,array(
							'id'=>'K.'.$item['id'],
							'acc_code'=>$item['acc_code'],
							'acc_name'=>$item['acc_name']
						));
					}
					foreach($listAccountDebit as $item){
						array_push($accountDebitArr,array(
							'id'=>'D.'.$item['id'],
							'acc_code'=>$item['acc_code'],
							'acc_name'=>$item['acc_name']
						));
					}
					echo json_encode(array('label'=>jurnalEntryLabel($id),'data'=>array('kredit'=>$accountKreditArr,'debit'=>$accountDebitArr)));
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function jurnalList(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$dataJournalArr = array();
				$limit = projectbase_post('limitPage');
				$page = (projectbase_post('page')-1)*$limit;
				if(projectbase_post('query') !=''){
					$dataJournal = projectbase_query_block("select * from trans_vw_journal_entry_tmp where uid='".$result['userdata']['id']."' and narative like '%".projectbase_post('query')."%' order by trandate desc LIMIT ".$page.",".$limit);
				}else{
					// echo "select * from trans_vw_journal_entry_tmp where uid='".$result['userdata']['id']."' order by trandate desc LIMIT ".$page.",".$limit;
					$dataJournal = projectbase_query_block("select * from trans_vw_journal_entry_tmp where uid='".$result['userdata']['id']."' order by trandate desc LIMIT ".$page.",".$limit);
				}
				foreach($dataJournal->result_array() as $item){
					array_push($dataJournalArr,array(
						'id' => $item['id'],
						'trans_cat' => $item['trans_cat'],
						'amount' => $item['amount'],
						'narative' => base64_encode($item['narative']),
						'account_desc' => $item['account_desc'],
						'transcode' => $item['transcode'],
						'trandate' => $item['trandate'],
						'trans_cat_desc' => $item['trans_cat_desc']
					));
				}
				echo json_encode(array('success'=>true,'message_data'=>'Loaded data','results'=>count($dataJournalArr),'data'=>$dataJournalArr));
				// echo json_encode($dataJournalArr);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function jurnalEntry(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$acc_code = projectbase_post('acc_code');
				$trandate = projectbase_post('trandate');
				$transNo=strtotime($trandate);
				$transCode = $result['userdata']['id'].time();
				$accCredit=explode('.',projectbase_post('credit'));
				$accNameCreditArr = accountNameFilter($result['accountname'],'id',$accCredit[1]);
				foreach($accNameCreditArr as $item){
					$accNameCredit = $item;
				}
				$accDebit=explode('.',projectbase_post('debit'));
				$accNameDebitArr = accountNameFilter($result['accountname'],'id',$accDebit[1]);
				foreach($accNameDebitArr as $item){
					$accNameDebit = $item;
				}
				$narative = projectbase_post('narative');
				$amount = projectbase_post('amount');
				$insertJournalTmp = array(
					'trans_cat'=>$acc_code,
					'account_desc'=>jurnalEntryLabel($acc_code)['kredit'].' <b>'.$accNameCredit['acc_name'].'</b> '.jurnalEntryLabel($acc_code)['debit'].' <b>'.$accNameDebit['acc_name'].'</b>',
					'amount'=>$amount,
					'narative'=>$narative,
					'transcode'=>$transCode,
					'trandate'=>$trandate,
					'posted'=>1,
					'uid'=>$result['userdata']['id']
				);

				$insertData = array(
					array(
						'account_id'=>$accCredit[1],
						'amount'=>$accCredit[0]=='K' ? 0-$amount : $amount,
						'narative'=>$narative,
						'trandate'=>$trandate,
						'transno'=>$transNo,
						'transcode'=>$transCode,
						'posted'=>1
					),
					array(
						'account_id'=>$accDebit[1],
						'amount'=>$accCredit[0]=='D' ? 0+$amount : $amount,
						'narative'=>$narative,
						'trandate'=>$trandate,
						'transno'=>$transNo,
						'transcode'=>$transCode,
						'posted'=>1
					)
				);

				projectbase_process_block('INSERT','trans_journal_entry_tmp',$insertJournalTmp,$result['userdata']['id']);
				projectbase_process_block('INSERT_BATCH','trans_journal_entry',$insertData,$result['userdata']['id']);

				echo json_encode(array('status'=>true,'message'=>'Data added'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function jurnalDelete($id){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				projectbase_process_block('DELETE','trans_journal_entry_tmp','',$result['userdata']['id'],'id',$id);
				echo json_encode(array('status'=>true,'message'=>'Data deleted'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function verifyPassword(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				$dataPass = get_redis($headers['token-id'].'-password');
				$password = md5(projectbase_post('password'));
				if($dataPass == $password){
					echo json_encode(array('status'=>true,'message'=>'Access granted'));
				}else{
					echo json_encode(array('status'=>false,'message'=>'Invalid password'));
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function neraca($yearMonth){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// Account Section
				$accountSectionRedis = get_redis('accountSection');
				if($accountSectionRedis != ''){
					$accountSectionRedisResult = json_decode($accountSectionRedis, true);
				}else{
					$dataAccountSectionArr = array();
					$dataAccountSection = projectbase_query_block('select * from jarvis_parameter where id in(202,203)');
					foreach($dataAccountSection->result_array() as $section){
						array_push($dataAccountSectionArr,array(
							'id' => $section['id'],
							'parameter' => $section['parameter']
						));
					}
					$accountSectionRedisResult = $dataAccountSectionArr;
					save_redis('accountSection', json_encode($accountSectionRedisResult), 3600);
				}

				// Account Group
				$accountGroupRedis = get_redis('accountGroup');
				if($accountGroupRedis != ''){
					$accountGroupRedisResult = json_decode($accountGroupRedis, true);
				}else{
					$dataAccountGroupArr = array();
					$dataAccountGroup = projectbase_jarvis_get_data('acc_group_name','adm_vw_account_groups','sort_number','asc','',array('profit_n_loss'=>'no'));
					foreach($dataAccountGroup['data'] as $item){ 
						array_push($dataAccountGroupArr,array(
							'id' => $item['id'],
							'acc_group_name' => $item['acc_group_name'],
							'section_id' => $item['section_id'],
							'section_name' => $item['section_name']
						));
					}
					$accountGroupRedisResult = $dataAccountGroupArr;
					save_redis('accountGroup', json_encode($accountGroupRedisResult), 3600);
				}

				// Account Name
				$dataAccountNameArr = array();
				$dataAccountName = accountNameFilter($result['accountname'],'profit_n_loss','no');
				foreach($dataAccountName as $item){
					array_push($dataAccountNameArr,$item);
				}

				// Jurnal
				$dataJournalReportArr = array();
				$journalReport = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('user_id'=>$result['userdata']['id'],'profit_n_loss'=>'no','journal_year_month <='=>$yearMonth));
				foreach($journalReport['data'] as $item){ 
					array_push($dataJournalReportArr,array(
						'id' => $item['id'],
						'group_id' => $item['group_id'],
						'account_id' => $item['account_id'],
						'acc_code' => $item['acc_code'],
						'section_id' => $item['section_id'],
						'amount' => $item['amount']
					));
				}
				$journalReportFinal = array('success'=>true, 'results'=>count($dataJournalReportArr), 'data'=>$dataJournalReportArr);

				// Laba Ditahan
				$dataLabaDitahanArr = array();
				$labaDiTahan = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('user_id'=>$result['userdata']['id'],'profit_n_loss'=>'yes','journal_year_month <='=>$yearMonth));
				foreach($labaDiTahan['data'] as $item){ 
					array_push($dataLabaDitahanArr,array(
						'id' => $item['id'],
						'group_id' => $item['group_id'],
						'account_id' => $item['account_id'],
						'acc_code' => $item['acc_code'],
						'section_id' => $item['section_id'],
						'amount' => $item['amount']
					));
				}
				$labaDiTahanFinal = array('success'=>true, 'results'=>count($dataLabaDitahanArr), 'data'=>$dataLabaDitahanArr);

				echo json_encode(
					array(
						'accountSection' => $accountSectionRedisResult,
						'accountGroup' => $accountGroupRedisResult,
						'accountname' => $dataAccountNameArr,
						'journalReport' => $journalReportFinal,
						'labaDiTahan' => $labaDiTahanFinal
					)
				);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function neracaAccount($accountID,$yearMonth){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// Account Name
				$dataAccountNameArr = accountNameFilter($result['accountname'],'id',$accountID);
				foreach($dataAccountNameArr as $item){
					$dataAccountName = $item;
				}

				// Saldo Awal
				$rsFwdBalanceArr = array();
				if($dataAccountName['acc_code']=='3500'){
					$rsFwdBalance= projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('user_id'=>$result['userdata']['id'],'profit_n_loss'=>'yes','journal_year_month <='=>$yearMonth));
				}else{
					$rsFwdBalance= projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','id','asc','',array('account_id'=>$accountID,'journal_year_month <'=>$yearMonth));
				}
				foreach($rsFwdBalance['data'] as $item){
					array_push($rsFwdBalanceArr,array(
						'id'=>$item['id'],
						'section_id'=>$item['section_id'],
						'section_name'=>$item['section_name'],
						'group_id'=>$item['group_id'],
						'acc_group_name'=>$item['acc_group_name'],
						'account_id'=>$item['account_id'],
						'acc_code'=>$item['acc_code'],
						'acc_name'=>$item['acc_name'],
						'amount'=>$item['amount'],
						'tanggal'=>$item['trandate'],
						'transno'=>$item['transno'],
						'transcode'=>$item['transcode'],
						'narative'=>base64_encode($item['narative'])
					));
				}

				// Jurnal Entries
				$dataJournalEntryArr = array();
				$dataJournalEntry = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','trandate','asc','',array('account_id'=>$accountID,'journal_year_month'=>$yearMonth));
				foreach($dataJournalEntry['data'] as $item){
					array_push($dataJournalEntryArr,array(
						'id'=>$item['id'],
						'section_id'=>$item['section_id'],
						'section_name'=>$item['section_name'],
						'group_id'=>$item['group_id'],
						'acc_group_name'=>$item['acc_group_name'],
						'account_id'=>$item['account_id'],
						'acc_code'=>$item['acc_code'],
						'acc_name'=>$item['acc_name'],
						'amount'=>$item['amount'],
						'tanggal'=>$item['trandate'],
						'transno'=>$item['transno'],
						'transcode'=>$item['transcode'],
						'narative'=>base64_encode($item['narative'])
					));
				}

				echo json_encode(
					array(
						'accountname' => $dataAccountName,
						'accountCode' => $dataAccountName['acc_code'],
						'dataFwdBalance' => $rsFwdBalanceArr,
						'dataJournalEntry' => $dataJournalEntryArr
					)
				);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function neracaAccountTransno($transNo){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// Jurnal entries
				$dataJournalEntryArr = array();
				$dataJournalEntry = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','trandate','asc','',array('transno'=>$transNo,'user_id'=>$result['userdata']['id']));
				foreach($dataJournalEntry['data'] as $item){
					array_push($dataJournalEntryArr,array(
						'id'=>$item['id'],
						'section_id'=>$item['section_id'],
						'section_name'=>$item['section_name'],
						'group_id'=>$item['group_id'],
						'acc_group_name'=>$item['acc_group_name'],
						'account_id'=>$item['account_id'],
						'acc_code'=>$item['acc_code'],
						'acc_name'=>$item['acc_name'],
						'amount'=>$item['amount'],
						'tanggal'=>$item['trandate'],
						'transno'=>$item['transno'],
						'transcode'=>$item['transcode'],
						'narative'=>base64_encode($item['narative'])
					));
				}

				echo json_encode(
					array(
						'dataJournalEntry' => $dataJournalEntryArr
					)
				);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function labaRugi($year,$month=''){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// Account Group
				$accountGroupRedis = get_redis('accountGroupLabaRugi');
				if($accountGroupRedis != ''){
					$accountGroupRedisResult = json_decode($accountGroupRedis, true);
				}else{
					$dataAccountGroupArr = array();
					$dataAccountGroup = projectbase_jarvis_get_data('acc_group_name','adm_vw_account_groups','sort_number','asc','',array('profit_n_loss'=>'yes'));
					foreach($dataAccountGroup['data'] as $item){ 
						array_push($dataAccountGroupArr,array(
							'id' => $item['id'],
							'acc_group_name' => $item['acc_group_name'],
							'section_id' => $item['section_id'],
							'section_name' => $item['section_name']
						));
					}
					$accountGroupRedisResult = $dataAccountGroupArr;
					save_redis('accountGroupLabaRugi', json_encode($accountGroupRedisResult), 3600);
				}

				// Account Name
				$dataAccountNameArr = array();
				$dataAccountName = accountNameFilter($result['accountname'],'profit_n_loss','yes');
				foreach($dataAccountName as $item){
					array_push($dataAccountNameArr,$item);
				}

				// Laba Rugi
				if($year != '' && $month != ''){
					$journalReportArrData = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('user_id'=>$result['userdata']['id'],'profit_n_loss'=>'yes','journal_month'=>$month,'journal_year'=>$year));
					$journalReportArr = array();
					$subtotals = [];
					foreach($journalReportArrData['data'] as $item){
						array_push($journalReportArr,array(
							'id'=>$item['id'],
							'account_id'=>$item['account_id'],
							'acc_code'=>$item['acc_code'],
							'group_id'=>$item['group_id'],
							'section_id'=>$item['section_id'],
							'amount'=>$item['amount']
						));
						$subtotal = isset($subtotals[$item['group_id']]) ? $subtotals[$item['group_id']] : 0;
						$subtotals[$item['group_id']]= $subtotal + $item['amount'];
					}
					$tglfilter = $year.'-'.$month.'-01';
					$compare=date('Y-m-d', strtotime('July 01 2018'));
					if($tglfilter >= $compare){
						$profitLossPercentage=((isset($subtotals[1]) ? $subtotals[1] : 0) * -1)*projectbase_call_configuration('pph_ukm_05_persen');
					}else{
						$profitLossPercentage=(((isset($subtotals[1]) ? $subtotals[1] : 0) * -1)-(isset($subtotals[2]) ? $subtotals[2] : 0))*projectbase_call_configuration('pph_ukm');
					}
					$profitNLossBeforeTax = ((isset($subtotals[1]) ? $subtotals[1] : 0)* -1)-(isset($subtotals[2]) ? $subtotals[2] : 0);
					$profitNLossBeforeTaxFinal = $profitNLossBeforeTax-$profitLossPercentage;
				}else{
					$journalReportArrData = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('user_id'=>$result['userdata']['id'],'profit_n_loss'=>'yes','journal_year'=>$year));
					$journalReportArr = array();
					$subtotals = [];
					foreach($journalReportArrData['data'] as $item){
						array_push($journalReportArr,array(
							'id'=>$item['id'],
							'account_id'=>$item['account_id'],
							'acc_code'=>$item['acc_code'],
							'group_id'=>$item['group_id'],
							'section_id'=>$item['section_id'],
							'amount'=>$item['amount']
						));
						$subtotal = isset($subtotals[$item['journal_year_month']][$item['group_id']]) ? $subtotals[$item['journal_year_month']][$item['group_id']] : 0;
						$subtotals[$item['journal_year_month']][$item['group_id']]= $subtotal + $item['amount'];
					}
					// echo json_encode($subtotals);
					$profitLossPercentageArr = array();
					foreach($subtotals as $key => $value){
						if($key >= 201801){
							$hitungPersen = ((isset($value[1]) ? $value[1] : 0) * -1)*projectbase_call_configuration('pph_ukm_05_persen');
						}else{
							$hitungPersen= (((isset($value[1]) ? $value[1] : 0) * -1) - (isset($value[2]) ? $value[2] : 0))*projectbase_call_configuration('pph_ukm');
						}
						$hitungBeforeTax = ((isset($value[1]) ? $value[1] : 0) * -1)-(isset($value[2]) ? $value[2] : 0);
						$hitungAfterTax = $hitungBeforeTax-$hitungPersen;
						array_push($profitLossPercentageArr,array(
							'profitLossPercentage'=>$hitungPersen,
							'profitNLossBeforeTax'=>$hitungBeforeTax,
							'profitNLossBeforeTaxFinal'=>$hitungAfterTax,
						));
					}
					// echo json_encode($profitLossPercentageArr);
					$sumProfitNLossBeforeTax = 0;
					$sumProfitLossPercentage = 0;
					$sumProfitNLossBeforeTaxFinal= 0;
					foreach($profitLossPercentageArr as $itemPL){ 
						$sumProfitNLossBeforeTax += $itemPL['profitNLossBeforeTax'];
						$sumProfitLossPercentage += $itemPL['profitLossPercentage'];
						$sumProfitNLossBeforeTaxFinal += $itemPL['profitNLossBeforeTaxFinal'];
					}
					$profitLossPercentage = $sumProfitLossPercentage;
					$profitNLossBeforeTax = $sumProfitNLossBeforeTax;
					$profitNLossBeforeTaxFinal = $sumProfitNLossBeforeTaxFinal;
				}
				
				echo json_encode(
					array(
						'accountGroup' => $accountGroupRedisResult,
						'accountname' => $dataAccountNameArr,
						'journalReport' => $journalReportArr,
						'profitNLossBeforeTax' => $profitNLossBeforeTax,
						'profitLossPercentage' => round($profitLossPercentage),
						'profitNLossBeforeTaxFinal' => round($profitNLossBeforeTaxFinal)
					)
				);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function labaRugiAccount($accountID,$year,$month=''){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// Account Name
				$dataAccountNameArr = array();
				$dataAccountName = accountNameFilter($result['accountname'],'profit_n_loss','yes');
				foreach($dataAccountName as $item){
					array_push($dataAccountNameArr,$item);
				}

				// Journal Entries
				$dataJournalEntryArr = array();
				if($year != '' && $month != ''){
					$dataJournalEntry = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('account_id'=>$accountID,'journal_year'=>$year,'journal_month'=>$month));
				}else{
					$dataJournalEntry = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('account_id'=>$accountID,'journal_year'=>$year));
				}
				foreach($dataJournalEntry['data'] as $item){
					array_push($dataJournalEntryArr,array(
						'id'=>$item['id'],
						'section_id'=>$item['section_id'],
						'section_name'=>$item['section_name'],
						'group_id'=>$item['group_id'],
						'acc_group_name'=>$item['acc_group_name'],
						'account_id'=>$item['account_id'],
						'acc_code'=>$item['acc_code'],
						'acc_name'=>$item['acc_name'],
						'amount'=>$item['amount'],
						'tanggal'=>$item['trandate'],
						'transno'=>$item['transno'],
						'transcode'=>$item['transcode'],
						'narative'=>base64_encode($item['narative'])
					));
				}

				echo json_encode(
					array(
						'accountname' => $dataAccountNameArr,
						'journalReport' => $dataJournalEntryArr
					)
				);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function labaRugiAccountTransno($transNo){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);

				// Journal Entries
				$dataJournalEntryArr = array();
				$dataJournalEntry = projectbase_jarvis_get_data('acc_name','trans_vw_journal_entry','acc_code','asc','',array('transno'=>$transNo,'user_id'=>$result['userdata']['id']));
				foreach($dataJournalEntry['data'] as $item){
					array_push($dataJournalEntryArr,array(
						'id'=>$item['id'],
						'section_id'=>$item['section_id'],
						'section_name'=>$item['section_name'],
						'group_id'=>$item['group_id'],
						'acc_group_name'=>$item['acc_group_name'],
						'account_id'=>$item['account_id'],
						'acc_code'=>$item['acc_code'],
						'acc_name'=>$item['acc_name'],
						'amount'=>$item['amount'],
						'tanggal'=>$item['trandate'],
						'transno'=>$item['transno'],
						'transcode'=>$item['transcode'],
						'narative'=>base64_encode($item['narative'])
					));
				}

				echo json_encode(
					array(
						'journalReport' => $dataJournalEntry
					)
				);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function resetPassword(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");

		$config = [
            'mailtype'  	=> 'html',
            'charset'   	=> 'utf-8',
            'protocol'  	=> 'smtp',
            'smtp_host' 	=> 'smtp.gmail.com',
            'smtp_user' 	=> 'noreply.lamikro@gmail.com',  // Email gmail
            'smtp_pass'   	=> 'L4m1kr0J4y4',  // Password gmail
            'smtp_crypto' 	=> 'ssl',
            'smtp_port'   	=> 465,
            'crlf'    		=> "\r\n",
            'newline' 		=> "\r\n"
        ];

        // Load library email dan konfigurasinya
		$this->load->library('email', $config);
		
		$token = random_string('md5');
        
        $email = projectbase_post('email');
        $result = projectbase_jarvis_get_data('username','jarvis_user','id','asc','',array('email'=>$email));
        if($result['results']==1){
			$sess_array = array();
			foreach($result['data'] as $row){
				// Email dan nama pengirim
				$this->email->from('noreply.lamikro@gmail.com', 'Lamikro');
				// Email penerima
				$this->email->to($email); // Ganti dengan email tujuan
				// Subject email
				$this->email->subject('Mengatur Ulang Kata Sandi LAMIKRO');
				// Isi email
				$this->email->message("
					<table border='0' cellpadding='0' cellspacing='0' width='100%>
						<tr>
							<td style='padding: 10px 0 30px 0;'>
								<table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #E4E4E4; border-collapse: collapse;'>
									<tr>
										<td align='center' bgcolor='#F5F5F5' style='padding: 15px 30px 15px 23px; border-bottom: 1px solid #E4E4E4; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
											<img src='https://lamikro.com/public/images/logo/logo.jpg' width='250'/>
										</td>
									</tr>
									<tr>
										<td style='padding: 40px 30px 40px 30px; font-size:14px;'>
											Kepada Yth.  <b>".$row['name']."</b>, <p>

											Kami menerima permintaan untuk mengatur ulang kata sandi untuk akun LAMIKRO Anda.<br>
											Harap gunakan tautan berikut untuk mengatur kata sandi baru.<p>
											
											Username : <b>".$row['username']."</b><p>
											
											https://lamikro.com/app/new_password?d=".$token." <p>
											
											(Jika tautan di atas tidak berhasil, silakan salin URL dan tempelkan ke browser Anda.) <p><p>
											
											
											Salam hangat,<br>
											Tim LAMIKRO
										</td>
									</tr>
									<tr>
										<td style='background-color:#ee4c50; padding: 0px 30px 0px 30px;'>
											<table border='0' cellpadding='0' cellspacing='0' width='100%'>
												<tr> <td style='color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; height:30px;'>&reg; LAMIKRO<br/></td></tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				");

				// Tampilkan pesan sukses atau error
				if ($this->email->send()) {
					save_redis($token.'-newPassword', json_encode(
						array(
							'id'=>$row['id']
						)
					), 3600);
					echo json_encode(array('status'=>true,'message'=>$token));
				} else {
					echo 'Error! email tidak dapat dikirim.';
				}
			}
		}else{
            echo json_encode(array('status'=>false,'message'=>'Email not registered'));
		}
	}
	function newPassword(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id'].'-newPassword');
			if($data != ''){
				$result = json_decode($data, true);
				$password = md5(projectbase_post('password'));
				$data_update = array(
					'password'=>$password
				);
				projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['id'],'id',$result['id']);
				echo json_encode(array('status'=>true,'message'=>'Data updated'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function uploadLogo(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = json_decode($data, true);
				// Logo
				$image_parts = explode(";base64,", projectbase_post("logo_base64"));
				$image_type_aux = explode("image/", $image_parts[0]);
				$image_type = $image_type_aux[1];
				$image_base64 = base64_decode($image_parts[1]);
				// decoding base64 string value
				$image_name = md5(uniqid(rand(), true));// image name generating with random number with 32 characters
				$filename = $image_name . '.' . 'jpg';
				//rename file name with random number
				$path = 'logo/';
				//image uploading folder path
				file_put_contents($path . $filename, $image_base64);
				$data_update = array(
					'avatar'=>$filename
				);
				projectbase_process_block('UPDATE','jarvis_user',$data_update,$result['userdata']['id'],'id',$result['userdata']['id']);
				$sess_array = array(
					'userdata' => array(
						'id' => $result['userdata']['id'], 
						'username' => $result['userdata']['username'], 
						'name' => $result['userdata']['name'], 
						'email' => $result['userdata']['email'], 
						'tgl_lahir' => $result['userdata']['tgl_lahir'], 
						'gender' => $result['userdata']['gender'], 
						'phone_number' => $result['userdata']['phone_number'], 
						'address' => $result['userdata']['address'], 
						'no_ktp' => $result['userdata']['no_ktp'],
						'npwp' => $result['userdata']['npwp'], 
						'avatar' => $filename, 
						'ref_group_user' => $result['userdata']['ref_group_user'], 
						'group' => $result['userdata']['group'],
						'company' => $result['userdata']['company'], 
						'iumkm' => $result['userdata']['iumkm'], 
						'jenis_usaha' => $result['userdata']['jenis_usaha'], 
						'alamat_usaha' => $result['userdata']['alamat_usaha'] 
					),
					'accountname' => $result['accountname']
				);
				save_redis($headers['token-id'], json_encode($sess_array), 604800);
				echo json_encode(array('status'=>true,'message'=>'Data updated'));				
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function lamikroSummaryUser(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			if($data != ''){
				$result = projectbase_jarvis_get_data('jumlah','dashboard_user_sum','jumlah','asc','');
				echo json_encode($result);
			}else{
				echo json_encode(array('status'=>false,'message'=>'Token expired'));
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function testing(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Methods: *");
		
		$headers = apache_request_headers();
		if(isset($headers['token-id'])){
			$data = get_redis($headers['token-id']);
			$result = json_decode($data, true);
			$new_array = accountNameFilter($result['accountname'],'id','3505');
			echo json_encode($new_array[0]['acc_name']);
			echo jurnalEntryLabel(206)['kredit'];
		}else{
			echo json_encode(array('status'=>false,'message'=>'Invalid token'));
		}
	}
	function testing_email(){
		$config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'noreply.lamikro@gmail.com',  // Email gmail
            'smtp_pass'   => 'L4m1kr0J4y4',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('noreply.lamikro@gmail.com', 'Lamikro');

        // Email penerima
        $this->email->to('aldian.gnusa@gmail.com'); // Ganti dengan email tujuan

        // Subject email
        $this->email->subject('Mengatur Ulang Kata Sandi LAMIKRO');

        // Isi email
		$this->email->message("
			<table border='0' cellpadding='0' cellspacing='0' width='100%>
				<tr>
					<td style='padding: 10px 0 30px 0;'>
						<table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #E4E4E4; border-collapse: collapse;'>
							<tr>
								<td align='center' bgcolor='#F5F5F5' style='padding: 15px 30px 15px 23px; border-bottom: 1px solid #E4E4E4; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
									<img src='http://new.lamikro.com/images/logo/logo.jpg' width='200'/>
								</td>
							</tr>
							<tr>
								<td style='padding: 40px 30px 40px 30px; font-size:14px;'>
									Kepada Yth.  <b>Aldian Putra</b>, <p>

									Kami menerima permintaan untuk mengatur ulang kata sandi untuk akun LAMIKRO Anda.<br>
									Harap gunakan tautan berikut untuk mengatur kata sandi baru.<p>
									
									Username : <b>aldianEp</b><p>
									
									https://lamikro.com/ID/id/Login/ResetPassword?d=OlFIBusWvpIQXR1VohxcsLgsACej%252 <p>
									
									(Jika tautan di atas tidak berhasil, silakan salin URL dan tempelkan ke browser Anda.) <p><p>
									
									
									Salam hangat,<br>
									Tim LAMIKRO
								</td>
							</tr>
							<tr>
								<td style='background-color:#ee4c50; padding: 0px 30px 0px 30px;'>
									<table border='0' cellpadding='0' cellspacing='0' width='100%'>
										<tr> <td style='color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; height:30px;'>&reg; Lamikro<br/></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
	}
	function getTokenNewPassword($token){
		// 69efc68c2e5eadfcaa64caa7664824cd
		echo get_redis($token.'-newPassword');
	}
}
