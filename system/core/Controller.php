<?php
class Controller {
	
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