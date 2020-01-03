<?php

/**
* @Author Deepak
* @Class Core Service
* @Date 21/01/2016  
*/
class Service{

	public static $vars;
	public static $class; 

	public static $model;
	public static $view;

	function __construct(){

		// get the user defined class
		Service::$class = get_called_class();
        
        // call curresponding functions according to request method  
		switch(Service::requestMethod()){
			case 'GET': call_user_func(array(Service::$class, 'get'));
			break;

			case 'POST': call_user_func(array(Service::$class, 'post'));
			break;

			case 'PUT': call_user_func(array(Service::$class, 'put'));
			break;

			case 'DELETE': call_user_func(array(Service::$class, 'delete'));
			break;
		}
	}

	public static function load($handler, $vars=NULL){
		$path = 'services/';
		$file = $path.$handler.'.php';

		Service::$vars = $vars;

		if(file_exists($file)){
			require_once $file;
			// Initialize controller 
			new $handler;
		}else{
			echo "Service ".$handler." not Found";
		}

	}

	public static function requestMethod(){
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function loadModel($model){
		$path = 'models/';
		$file = $path.$model.'.php';

		Service::$model = $model;
		require_once $file;
	}

	public static function loadView($view){
		require_once 'core/view/Twig/Autoloader.php';
		Twig_Autoloader::register();

		$loader = new Twig_Loader_Filesystem('views');
		$twig = new Twig_Environment($loader);

		echo $twig->render($view.'.html', Model::$templateData);
	}

	public static function getVars(){
		return Service::$vars;
	}

	public static function getAjaxData(){
		return json_decode(file_get_contents('php://input'), TRUE);
	}


}