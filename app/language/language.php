<?php
class language extends MY_Controller {
	function __construct() {
		
	}
	function lang() {
		if(isset($_POST['language'])){
			$_SESSION['language'] = $_POST['language'];
		}
		$rs = isset($_SESSION['language']) ? $_SESSION['language'] : 'vi';
		require_once "lang_".$rs.".php";
		$lang = lang();
		//print_r($lang);
		$str=ob_get_clean();
		foreach($lang as $k => $v) {
			$str = str_replace("{".$k."}" ,$v, $str);
		}
		
		return $str;
	}
}