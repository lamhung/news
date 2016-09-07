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
	
	function __autoload($class_name) {
		require_once ("app/config/router.php");

		$filename = '';
		$router = router();
		$arr = parseUrl();
		//print_r($arr);
		$app_path  = APP_PATH;
		$url = '';

		if(substr($class_name, 0, 2) == 'M_'){
			$filename = 'app/models/'.$class_name.'.php';
		}elseif(substr($class_name, 0, 8) == 'language') {
			$filename = 'app/language/'.$class_name.'.php';
		}else{
			foreach ($arr as $value) {
				$app_path.='/'.$value;
				if(is_dir($app_path)) {
					$url .= '/'.$value;
				}
			}
			$url = trim($url.'/'.$class_name,'/');
			
			foreach($router as $k => $v) {		
				if(trim($url) == trim($k)) {	
					$filename = APP_PATH.'/'.$v.'/'.$class_name.'.php';
				}
			}
			
			//echo '<br>'.$filename;
		}
		//echo $filename;
		
		if(file_exists($filename)) {require_once($filename);}
	}
	//url
	function parseUrl() {
		if(isset($_GET['url'])) {
			$url = trim($_GET['url'], '/');
			$arr = explode('/', $url);
			return $arr;
		}
	}

	//tach url
	function tach_url(&$c_name, &$action, &$params) {
		$arr = parseUrl();

		if(count($arr) == 0) return FALSE;
		$count = 0;
		$app_path  = APP_PATH;
		foreach ($arr as $value) {
			$app_path.='/'.$value;

			if(is_dir($app_path)) {			
				$count += 1;
			}
		}
		//echo $app_path;
		if(isset($arr[$count])) {
			$c_name = $arr[$count];
		}
		if($c_name == "") {
			$c_name = DEFAULT_CONTROLLER;
			$action = DEFAULT_ACTION;
			$params = NULL;
			return true;
		}
		if(isset($arr[$count + 1])) {
			$action = $arr[$count + 1];
		}
		if($action == "") {
			$action = DEFAULT_ACTION;
			$params = NULL;
			return true;
		}

		for($i = 1; $i <= $count+2; $i++) {
			array_shift($arr);
		}
		$params = $arr;
		//print_r($params);
	}

		

	
	
	
	$lang = new language;
	echo $lang->lang();
	
	
		
		
		
		
			
		
		
	