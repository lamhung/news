<?php

if(!function_exists('directory_exist')) {
	
	/**
     * Check directory exist
     *
     * @param	string
     * @return	boolean
     */
	
	function directory_exist($directory = '') {
		return is_dir(UPLOAD_PATH.$directory);
	}	
	
}
if(!function_exists('create_directory')) {
/**
     * Create directory
     *
     * @param	string
     * @return	string
     */
	 function create_directory($directory = '') {
		$arr = explode('/', $directory);
		$path = substr(UPLOAD_PATH, 0, -1);
		foreach($arr as $v) {
			if($v != "") {
			$path .= '/'.$v;
				if(!is_dir($path)) {
					mkdir($path,0777);
				}
			}
		}
		 
	 }
}
