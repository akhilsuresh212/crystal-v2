<?php

/**
* @Author Deepak
* @Class AES 128 bit CBC Encryption and Decryption
* @Date 23/01/2016  
*/
class Aes{

	public static function encrypy($vars){
		$postedVars = array_keys(Service::getVars());
		$diff = array_merge(array_diff($vars,$postedVars),array_diff($postedVars,$vars));
		if(empty($diff)){
			return true;
		}else{
			$message = "Missing ".implode(', ', $diff)." Parameter(s)";
			header('HTTP/1.0 400 Bad Request');
			$response = array(
				'status' => 'error',
				'message'=> '400 Bad Request - '.$message
				);
			echo json_encode($response);
			exit;
		}
	}
}