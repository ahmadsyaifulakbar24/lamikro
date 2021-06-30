<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

function projectbase_encode($value){
	$ci =& get_instance();
	return $ci->jarvisclassencrypt->encode($value);
}
function projectbase_decode($value){
	$ci =& get_instance();
	return $ci->jarvisclassencrypt->decode($value);
}
function xor_this($string){
	// Let's define our key here
    $key = ('magic_key');

    // Our plaintext/ciphertext
    $text = $string;

    // Our output text
    $outText = '';

    // Iterate through each character
    for($i=0; $i<strlen($text); )
    {
        for($j=0; ($j<strlen($key) && $i<strlen($text)); $j++,$i++)
        {
            $outText .= $text{$i} ^ $key{$j};
            //echo 'i=' . $i . ', ' . 'j=' . $j . ', ' . $outText{$i} . '<br />'; // For debugging
        }
    }
    return $outText;
}
function projectbase_decrypt_server_side($messageParse,$ivParse,$keyParse){
	$ci =& get_instance();
	return $ci->jarvisclassencrypt->decryptServerSide($messageParse,$ivParse,$keyParse);
}
function projectbase_check_email($email){
	$ci =& get_instance();
	return $ci->qbclassm->checkEmail($email);
}
function projectbase_call_configuration($key){
	$ci =& get_instance();
	return $ci->qbclassm->jarvis_call_configuration($ci->qbclassc,$ci->QBmodel,$key);
}
function projectbase_session_set($session_name,$value){
	$ci =& get_instance();
	return $ci->session->set_userdata($session_name,$value);
}
function projectbase_session_get($session_name,$key){
	$ci =& get_instance();
	$session_data = $ci->session->userdata($session_name);
	return $session_data[$key];
}
function projectbase_session_unset($session_name){
	$ci =& get_instance();
	return $ci->session->unset_userdata($session_name);
}
function projectbase_session_destroy(){
	$ci =& get_instance();
	return $ci->session->sess_destroy();
}
function projectbase_group_menu_permission($auth_index){
	$ci =& get_instance();
	return $ci->qbclassc->qb_menu_group_permission($ci->QBmodel,$auth_index);
}
function projectbase_button_menu_permission($vw,$auth_index){
	$ci =& get_instance();
	return $ci->qbclassm->js_button_permission($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$vw,$auth_index);
}
function projectbase_hash_pass($password){
	$ci =& get_instance();
	return $ci->jarvisclassencrypt->jarvisHashPassword($password);
}
function projectbase_call_params($key){
	$ci =& get_instance();
	$paramsArr=array();
	$getParams=$ci->qbclassm->jarvis_get_data($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,'c_params','t_params','id','ASC','','');
	foreach($getParams['data'] as $itemParams){
		$paramsArr[$itemParams['c_kategori_params']]=$itemParams['c_params'];
	}
	return $paramsArr[$key];
}
function projectbase_get_global_var($key){
	$decode = json_decode(file_get_contents("php://input"),true);				
	$records=$decode["data"];
	return $records[$key];
}
function projectbase_str_pos($haystack, $needles=array(), $offset=0){
	$chr = array();
	foreach($needles as $needle) {
			$res = strpos($haystack, $needle, $offset);
			if ($res !== false) $chr[$needle] = $res;
	}
	if(empty($chr)) return false;
	return min($chr);
}
function projectbase_post($field){
	$ci =& get_instance();
	return $ci->input->post($field);
}
function projectbase_get($key){
	$ci =& get_instance();
	return $ci->input->get($key,true);
}
function projectbase_process_block($key_params,$tbl,$data,$ref_user,$colname='',$pk='',$not_use_audit=''){
	$ci =& get_instance();
	return $ci->qbclassc->qb_json_proses_blok($key_params,$ci->QBmodel,$tbl,$data,$ref_user,$colname,$pk,$not_use_audit);
}
function projectbase_get_data($search_field,$vw,$order_field,$order_type,$get_limit='',$params_where='',$argsBlock=''){
	$ci =& get_instance();
	return $ci->qbclassm->json_get_data($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$search_field,$vw,$order_field,$order_type,$get_limit,$params_where,$argsBlock);
}
function projectbase_jarvis_get_data($search_field,$vw,$order_field,$order_type,$get_limit='',$params_where='',$argsBlock=''){
	$ci =& get_instance();
	return $ci->qbclassm->jarvis_get_data($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$search_field,$vw,$order_field,$order_type,$get_limit,$params_where,$argsBlock);
}
function projectbase_json_save_data($tabel,$fld_name,$fld_type,$fld_count,$fld_ori,$ref_user){
	$ci =& get_instance();
	return $ci->qbclassm->json_save_data($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$tabel,$fld_name,$fld_type,$fld_count,$fld_ori,$ref_user);
}
function projectbase_json_update_data($fld_name,$tbl,$fld_type,$fld_count,$fld_ori,$fld_pk,$ref_user){
	$ci =& get_instance();
	return $ci->qbclassm->json_update($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$fld_name,$tbl,$fld_type,$fld_count,$fld_ori,$fld_pk,$ref_user);
}
function projectbase_json_delete_data($table,$field_pk,$ref_user){
	$ci =& get_instance();
	return $ci->qbclassm->json_delete_data($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$table,$field_pk,$ref_user);
}
function projectbase_query_block($query){
	$ci =& get_instance();
	return $ci->qbclassc->query_bloks($ci->QBmodel,$query);
}
function projectbase_remove_file($value){
    $files = glob($value);
    foreach($files as $file){
      if(is_file($file))
        unlink($file);
    }   
}
function projectbase_convert_field($field,$type){
	$ci =& get_instance();
	return $ci->qbclassc->cvrt_fld($field,$type);
}
function projectbase_selected_data_by_id_m($param,$tabel,$field){
	$ci =& get_instance();
	return $ci->qbclassm->getSelectedDataByIDm($ci->qbclassc,$ci->QBmodel,$param,$tabel,$field);
}
function projectbase_selected_data_by_id_s_m($param,$tabel){
	$ci =& get_instance();
	return $ci->qbclassm->getSelectedDataByIDsm($ci->qbclassc,$ci->QBmodel,$param,$tabel);
}
function projectbase_jarvis_check_activity($sessionID){
	$ci =& get_instance();
	return $ci->qbclassm->jarvis_check_activity($ci->qbclassc,$ci->QBmodel,$sessionID);
}
function projectbase_get_tree_node($vw,$order_field,$order_type,$auth_index,$params_where=''){
	$ci =& get_instance();
	return $ci->qbclassm->json_get_tree_node($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$vw,$order_field,$order_type,$auth_index,$params_where);
}
function projectbase_echo($key,$value){
	return $key['data'][0][$value];
}
function projectbase_get_data_user($value){
	$ci =& get_instance();
	$sessionID=projectbase_session_get('logged_in','id');
	$params_user=array('id'=>$sessionID);
	$data=projectbase_jarvis_get_data('c_username','vw_user','id','asc','',$params_user);
	return projectbase_echo($data,$value);
}
function uri_segment($segment){
	$ci =& get_instance();
	return $ci->uri->segment($segment);
}
function projectbase_get_data_not_in($param){
	$ci =& get_instance();
	return $ci->qbclassm->json_get_data_not_in($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$param);
}
function projectbase_get_tree_polri($vw,$order_field,$order_type,$auth_index,$params_where=''){
	$ci =& get_instance();
	return $ci->qbclassm->json_get_tree_polri($ci->qbclassc,$ci->qbclassvariable,$ci->QBmodel,$vw,$order_field,$order_type,$auth_index,$params_where);
}
function save_redis($key,$value,$expired){
	$ci =& get_instance();
	$ci->load->driver('cache');
	// return  $ci->cache->redis->save($key, $value, $expired);
	return  $ci->cache->file->save($key, $value, $expired);
}
function get_redis($key){
	$ci =& get_instance();
	$ci->load->driver('cache');
	// return  $ci->cache->redis->get($key);
	return  $ci->cache->file->get($key);
}
function delete_redis($key){
	$ci =& get_instance();
	$ci->load->driver('cache');
	// return  $ci->cache->redis->delete($key);
	return  $ci->cache->file->delete($key);
}
function accountNameFilter($arr,$key,$value){
	return array_filter($arr, function($item) use ($key,$value) {
		if($item[$key] == $value){
			return true;
		}
	});
}
function accountNameFilter2($arr,$key,$value){
	return array_filter($arr, function($item) use ($key,$value) {
		if(strstr($item[$key], $value)){
			return true;
		}
	});
}
function jurnalEntryLabel($key){
	$label = array(
		'206'=>array(
			'kredit'=>'Diterima Dari',
			'debit'=>'Simpan Ke'
		),
		'207'=>array(
			'kredit'=>'Diambil Dari',
			'debit'=>'Untuk'
		),
		'208'=>array(
			'kredit'=>'Hutang Dari',
			'debit'=>'Simpan Ke'
		),
		'209'=>array(
			'kredit'=>'Diambil Dari',
			'debit'=>'Untuk'
		),
		'210'=>array(
			'kredit'=>'Dari',
			'debit'=>'Simpan Ke'
		),
		'211'=>array(
			'kredit'=>'Diterima Dari',
			'debit'=>'Simpan Ke'
		),
		'212'=>array(
			'kredit'=>'Modal',
			'debit'=>'Simpan Ke'
		),
		'213'=>array(
			'kredit'=>'Diambil Dari',
			'debit'=>'Modal'
		),
		'214'=>array(
			'kredit'=>'Dari',
			'debit'=>'Ke'
		),
		'215'=>array(
			'kredit'=>'Dari',
			'debit'=>'Ke'
		)
	);
	return $label[$key];
}
function comboTypeAccount($key){
	$data = array(
		'206'=>'pemasukan',
		'207'=>'pengeluaran',
		'208'=>'hutang',
		'209'=>'bayar_hutang',
		'210'=>'piutang',
		'211'=>'dibayar_piutang',
		'212'=>'tambah_modal',
		'213'=>'tarik_modal',
		'214'=>'pengalihan_aset',
		'215'=>'penyesuaian',
	);
	return $data[$key];
}
