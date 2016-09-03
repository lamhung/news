<?php
if ( ! function_exists('set_value')) {
	
	function set_value($field, $default = '')
	{
		$value = "";
		if(isset($_POST[$field])) {
			$value = $_POST[$field];
		} else if(isset($default)) {
			$value = $default;
		}
		return $value;
	}
	
	function set_radio($field, $value = '', $default = FALSE) {
		$rs = "";
		
		if(isset($_POST[$field])) {
			$rs = $_POST[$field] == $value ?"checked = 'checked'" : "";
		}elseif(isset($value)){
			$rs = ($default == TRUE) ? "checked = 'checked'" : "";
		}
		return $rs;
	}
}