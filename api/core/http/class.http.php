<?php

/**
* @Author Deepak
* @Class CURL Request Class 
* @Date 21/01/2016  
*/
class Http{

	private static $ssl= true;
	private static $response;

	public static function disableSSL(){
		Http::$ssl = false;
	}

	public static function get($url){
		$agents = array();
		$agents[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0";
		$agents[] = "Mozilla/5.0 (Windows NT 6.1; rv:31.0) Gecko/20100101 Firefox/31.0";
		$agents[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36";
		$agents[] = "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)";
		$agent = $agents[array_rand($agents)];

		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL,$url); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('text/html; charset=gb2312')); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		if(!Http::$ssl){
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		}

		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($curl, CURLOPT_ENCODING, "");
		curl_setopt($curl, CURLOPT_USERAGENT, $agent);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 400);
		if(!$html = curl_exec($curl)){
			header('HTTP/1.0 500 Internal Server Error');
			header('Content-Type: application/json');
			$response = array(
				'status' => 'error',
				'message'=> 'cURL Error: '.curl_error($curl),
				);
			echo json_encode($response);
			exit;
		} 
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);
		Http::$response = $html;
		return $html;
	}

	public static function response(){
		return Http::$response;
	}
}