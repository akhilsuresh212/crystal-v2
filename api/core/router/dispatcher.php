<?php

/**
* @Author Deepak
* @Class Route Dispatcher
* @Date 20/01/2016  
*/
class Router extends Bootstrap{
	
	public function dispatch($dispatcher){

		// Fetch method and URI from somewhere
		$httpMethod = $_SERVER['REQUEST_METHOD'];
		$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

		$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

		switch ($routeInfo[0]) {

			case FastRoute\Dispatcher::NOT_FOUND:
			header('HTTP/1.0 404 End Point Not Found');
			header('Content-Type: application/json');
			$response = array(
				'status' => 'error',
				'message'=> '404 End Point Not Found'
				);
			echo json_encode($response);
			exit;
			break;

			case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
			$allowedMethods = $routeInfo[1];
			header('HTTP/1.0 405 Method Not Allowed');
			header('Content-Type: application/json');
			$response = array(
				'status' => 'error',
				'message'=> '405 Method Not Allowed'
				);
			echo json_encode($response);
			exit;
			break;

			case FastRoute\Dispatcher::FOUND:
			$handler = $routeInfo[1];
			$vars = $routeInfo[2];

			// get POST data
			if(empty($routeInfo[2])){
				$postVars = $_REQUEST;
				unset($postVars['url']);
				$vars = $postVars;
			}
            
            // get PUT, DELETE data
            if(empty($vars)){
            	parse_str(file_get_contents("php://input"),$vars);
            }

            // Check whether $vars is not in Array format
            if(!is_array($vars)){
            	$vars = json_decode($vars);
            }

			// ... call $handler with $vars
			Service::load($handler, $vars);
			break;
		}
	}

}