<?php

/**
 * @Author Deepak
 * @Class JSON Response Handling Class
 * @Date 23/01/2016  
 */
class Response
{

	public static function error($message, $response_code = 400)
	{
		http_response_code($response_code);
		header('Content-Type: application/json');
		$response = array(
			'status' => 'error',
			'message' => $message
		);
		echo json_encode($response);
		exit;
	}

	public static function success($message, $data = NULL)
	{
		header('HTTP/1.0 200 OK');
		header('Content-Type: application/json');
		$response = array(
			'status' => 'success',
			'message' => $message
		);
		if ($data) {
			$response['data'] = $data;
		}
		echo json_encode($response);
		exit;
	}
}
