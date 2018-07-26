<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class EncryptionFunction {
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
}
?>