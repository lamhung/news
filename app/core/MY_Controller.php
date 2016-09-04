<?php
class MY_Controller {
	public $params;
	public $lang;
	public $pagination;
	public $current_action;
	public $form_validation;
	public $upload;
	public $data = array();
	function __construct() {
		//echo "day là Controller<br>";
		
	}

	function view($string = '', $data = array()) {
		if($string) {
			if(substr($string, 0, -4) != ".php") {
				$string .= ".php";
			}
			if(file_exists($string)) {
				foreach($data as $k => $v) {
					$$k = $v;
				}
				require_once $string;
			} else {
				die("ko tim thay ".$string);
			}

		}
	}
}