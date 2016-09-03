<?php
	define('FCPATH', dirname(__FILE__));
	define('UPLOAD_PATH', FCPATH.'/upload/');
	
	ob_start('ob_gzhandler');
	session_start();
	require_once ("app/config/config.php");
	require_once ("system/core/Controller.php");
	require_once ("system/core/Model.php");
	require_once ("app/core/MY_Controller.php");
	require_once ("app/core/MY_Model.php");
	
	$result = tach_url($c_name, $action, $params);
	
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
	
	//url
	function url() {
		$url = ltrim($_SERVER['REQUEST_URI'], BASE_DIR);
		$arr = explode('/', $url);
		//echo $_SERVER['REQUEST_URI'];
		return $arr;
	}
	//Autoload
	function __autoload($class_name) {
		$arr = url();
		//print_r($arr);
		if(substr($class_name, 0, 2) == 'M_'){
			$filename = 'app/models/'.$class_name.'.php';
		}elseif(substr($class_name, 0, 8) == 'language') {
			$filename = 'app/language/'.$class_name.'.php';
		}
		else if($arr[0] == ADMIN){
			$filename = 'app/controllers/backend/'.$class_name.'.php';
		} else if($arr[0] != ADMIN ) {
			$filename = 'app/controllers/frontend/'.$class_name.'.php';
		} 
		//echo $filename;exit;
		if(file_exists($filename)) require_once($filename);
	}
	
	//tach url
	function tach_url(&$c_name, &$action, &$params) {
		$arr = url();
		//echo count($arr);
		//print_r($arr);
		if(count($arr) == 0) return FALSE;
		if($arr[0] == ADMIN) {
			if(isset($arr[1])) {
				$c_name = $arr[1];
			}
			//echo $c_name;exit;
			if($c_name == "") {
				$c_name = ADMIN_DEFAULT_CONTROLLER;
				$action = ADMIN_DEFAULT_ACTION;
				$params = NULL;
				return true;
			}
			if(isset($arr[2])) {
				$action = $arr[2];
			}
			if($action == "") {
				$action = ADMIN_DEFAULT_ACTION;
				$params = NULL;
				return true;
			}
				
			array_shift($arr);array_shift($arr);array_shift($arr);
			
			$params = $arr;
			//print_r($params);
		}
		else {
				$c_name = $arr[0];
				//echo $c_name;
			if($c_name == "") {
				$c_name = DEFAULT_CONTROLLER;
				$action = DEFAULT_ACTION;
				$params = NULL;
				return true;
			}
			if(isset($arr[1])) {
				$action = $arr[1];
			}
			if($action == "") {
				$action = DEFAULT_ACTION;
				//echo $action;
				$params = NULL;
				return true;
			}
				
			array_shift($arr);array_shift($arr);
			
			$params = $arr;
			//print_r($params);
		}
	}
	
	//lang
	$lang = new language;
	echo $lang->lang();
	
	
		
		
		
		
			
		
		
	