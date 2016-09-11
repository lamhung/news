<?php
	session_start();
	ob_start('ob_gzhandler');
	define('FCPATH', dirname(__FILE__));
	define('UPLOAD_PATH', FCPATH.'/upload/');

	require_once ("app/config/config.php");
	require_once ("system/core/Controller.php");
	require_once ("system/core/Model.php");
	require_once ("app/core/MY_Controller.php");
	require_once ("app/core/MY_Model.php");

	$result = tachUrl($c_name, $action, $params);

	//Kiêm tra controller
	if(class_exists($c_name, true)) {
		$c = new $c_name($action, $params);
	} else {
		$error = "Không tồn tại controller <strong>".$c_name."</strong>";
		die(require_once 'app/views/errors/error_404.php');
	}
	//Kiểm tra action
	if(method_exists($c, $action)) {
		$c->$action();
	} else {
		$error = "Không tồn tại action <strong>".$action."</strong>";
		die(require_once 'app/views/errors/error_404.php');
	}
	
	function __autoload($class_name) {
		$filename = '';
		$app_path  = APP_PATH;
		if(substr($class_name, 0, 6) == 'model_'){
			$filename = 'app/models/'.$class_name.'.php';
		}else
		if(substr($class_name, 0, 8) == 'language') {
			$filename = 'app/language/'.$class_name.'.php';
		}else{
			$array = set_routing();
			$arr = explode('/',trim($array['url_router'], '/'));
			//print_r($arr);
			foreach ($arr as $v) {
				$app_path.='/'.$v;
				if(is_dir($app_path)) {
					$path =	$app_path;
					$filename = $path.'/'.$class_name.'.php';
				}
			}
			
		}
		//echo $filename;
		
		if(file_exists($filename)) {require_once($filename);}
	}
	
	//url
	function parseUrl() {
		if(isset($_GET['url'])) {
			$url = trim($_GET['url'], '/');
			return $url;
		}
	}
	function set_routing() {
		require_once ("app/config/router.php");
		$router = router();
		$url = parseUrl();
		$array = array();
		foreach ($router as $key => $value) {
			$key  = str_replace(array('(:num)', '(:any)'), array('([0-9]+)', '([^/]+)'), $key);
			$pattern = '#^'.$key.'$#';

			if($url != "") {
				if (preg_match($pattern, $url, $matches)){
				    unset($matches[0]);
				    $array['params']= array_values($matches);
				    $array['url_router'] = $value;
				    //print_r($array);
				    return $array;

				} else {
					continue;
				}	
			}else {
				if (preg_match($pattern, 'default_controller', $matches)){    
				    $array['params'] = NULL;
				    $array['url_router'] = $value;
				    return $array;
				}else {
					continue;
				}
			} 
		}
		if(count($array) == 0) {
			die(require_once 'app/views/errors/error_404.php');
		}	
	}
	//set_routing();

	function tachUrl(&$c_name, &$action, &$params){
		$array['url_router'] = "";
		$array['params'] = array();

		$array = set_routing();
		$count = 0;
		$app_path  = APP_PATH;
		$arr = explode('/',trim($array['url_router'], '/'));
			//print_r($arr);
			foreach ($arr as $v) {
				$app_path.='/'.$v;
				if(is_dir($app_path)) {
					$path =	$app_path;
					$count += 1;
				}
			}
			//echo $path;
			if(isset($arr[$count])) {
				$c_name = $arr[$count];
			} else if(empty($c_name)){
				$c_name = DEFAULT_CONTROLLER;
				$action = DEFAULT_ACTION;
				$params = NULL;
				return true;
			}
			if(empty($arr[$count +1 ])) {
				$action = 'index';
				$params = NULL;
				return true;	
			}else {
				$action = $arr[$count+1];
			}

			if(count($array['params']) >0) {
				$params = $array['params'];
			} else {
				$params = NULL;
				return true;
			}
	}
	//tachUrl($c_name, $action, $params);

	$lang = new language;
	echo $lang->lang();
	