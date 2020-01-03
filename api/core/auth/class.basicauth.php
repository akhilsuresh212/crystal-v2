<?php

class BasicAuth
{
	private static $token;
	private static $method = 'strict'; // Authorization method. verify device if set to strict

	public static function getHeaders()
	{

		$headerStack = getallheaders(); // Requires php 5.4+ 

		if (isset($headerStack['Authorization'])) {
			BasicAuth::$token = end(explode(' ', $headerStack['Authorization']));
		} elseif (isset($headerStack['authorization'])) {
			BasicAuth::$token = end(explode(' ', $headerStack['authorization']));
		}


		if (in_array(BasicAuth::$token, TokenServer::getKeys())) {
			$device = explode('-', base64_decode(base64_decode(BasicAuth::$token)))[0];
			Log::setDevice($device);
			Log::access($_SERVER['REQUEST_URI']); //writting access logs
			return true;
		} else {
			Log::blocked_access($_SERVER['REQUEST_URI']); //writting access logs
			return false;
		}
	}

	public static function enable()
	{

		if (!BasicAuth::getHeaders()) {

			header('HTTP/1.0 401 Unauthorized');
			header('Content-Type: application/json');
			$response = array(
				'status' => 'error',
				'message' => '401 Unauthorized'
			);
			echo json_encode($response);
			exit;
		}
	}
}
