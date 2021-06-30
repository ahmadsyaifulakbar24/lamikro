<?php
/* 
 * File:   JarvisClassEncrypt.php
 * Author: Aldian Eka Putra
 *
 * Created on August 1, 2014, 08:07 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class JarvisClassEncrypt{
	private $skey 	= "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282"; // you can change it
    public function safe_b64encode($string) {

        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }    
	// Encrypt Function
	function encode($encrypt){
		$encrypt = serialize($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
		$key = pack('H*', $this->skey);
		$mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
		$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
		$encoded = $this->safe_b64encode($passcrypt).'|'.$this->safe_b64encode($iv);
		return $encoded;
	}	 
	// Decrypt Function
	function decode($decrypt){
		$decrypt = explode('|', $decrypt);
		$decoded = $this->safe_b64decode($decrypt[0]);
		$iv = $this->safe_b64decode($decrypt[1]);
		if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
		$key = pack('H*', $this->skey);
		$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
		$mac = substr($decrypted, -64);
		$decrypted = substr($decrypted, 0, -64);
		$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
		if($calcmac!==$mac){ return false; }
		$decrypted = unserialize($decrypted);
		return $decrypted;
	}
	// Decrypt Server Side Function
	function decryptServerSide($messageParse,$ivParse,$keyParse){
		$encrypted = base64_decode($messageParse); // data_base64 from JS
        $iv        = base64_decode($ivParse);   // iv_base64 from JS
        $key       = base64_decode($keyParse);  // key_base64 from JS
        $plaintext = rtrim(mcrypt_decrypt( MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv ), "\t\0 " );
		return $plaintext;
	}
	// HASH PASSWORD
	function jarvisHashPassword($secPassword){
		$jarvisSalt='$2a$07$MEfZZ0kOKunb/6VsJb1Ty7';
		return crypt($secPassword,$jarvisSalt);
	}
}
/* End of file JarvisClassEncrypt.php */
