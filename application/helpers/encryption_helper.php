<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Encryption {
	var $name = 'EncryptionFunctions';
	
	var $key = 'AAECAwQFBgcICQoLDA0ODw==';
	var $IV = 'AAECAxQFBbcICQoLDA0ODq==';

	function enCrypt($string) {
		$level_one = base64_encode($string);
		$cipher = urlencode($level_one);
			
		return $cipher;
	}

	function deCrypt($string) {
		$level_one = urldecode($string);
		$plainText = base64_decode($level_one);

		return $plainText;
	}

	function addpadding($string, $blocksize = 16) {
		$len = strlen($string);
		$pad = $blocksize - ($len % $blocksize);
		$string .= str_repeat(chr($pad), $pad);
		return $string;
	}

	function strippadding($string) {
		$slast = ord(substr($string, -1));
		$slastc = chr($slast);
		$pcheck = substr($string, -$slast);
		if(preg_match("/$slastc{".$slast."}/", $string)){
			$string = substr($string, 0, strlen($string)-$slast);
			return $string;
		} else {
			return false;
		}
	}

	function aes_encrypt($string = "") {
		$key = base64_decode($this->key);
		$iv = base64_decode($this->IV);

		//return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $this->addpadding($string), MCRYPT_MODE_CBC, $iv));
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $this->addpadding($string), MCRYPT_MODE_CBC, $iv));
	}

	function aes_decrypt($string = "") {
		$key = base64_decode($this->key);
		$iv = base64_decode($this->IV);

		$string = base64_decode($string);

		//return $this->strippadding(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_CBC, $iv));
		return $this->strippadding(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $string, MCRYPT_MODE_CBC, $iv));
	}
	
	function test_encrypt($val) {
		$key = $this->mysql_aes_key($this->key);
		$pad_value = 16-(strlen($val) % 16);
		$val = str_pad($val, (16*(floor(strlen($val) / 16)+1)), chr($pad_value));
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv( mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
	}

	function test_decrypt($val) {
		$key = $this->mysql_aes_key('Ralf_S_Engelschall__trainofthoughts');
		$val = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv( mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
		return rtrim($val, "\0..\16");
	}

	function mysql_aes_key($key) {
		$new_key = str_repeat(chr(0), 16);
		for($i=0,$len=strlen($key);$i<$len;$i++)
		{
			$new_key[$i%16] = $new_key[$i%16] ^ $key[$i];
		}
		return $new_key;
	}
	
	function generateRandomString($length = 4) {
		$characters 						= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength 					= strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString 				.= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
?>