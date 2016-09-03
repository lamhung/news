<?php
class lib_image {
	function __construct() {
		require_once "app/helpers/hel_directory.php";
	}
	
	function upload_one($input_name, $directory) {
		$result = array();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if($_FILES[$input_name]['tmp_name'] != "") {
				
				if(!directory_exist($directory)) {
					create_directory($directory);
				}
				
				$taget_dir = UPLOAD_PATH.$directory.'/';
				$success = TRUE;
				$taget_file = $taget_dir.basename($_FILES[$input_name]['name']);
				$imageFileType = pathinfo($taget_file, PATHINFO_EXTENSION);
				
				$file_name = time();
				$image_path = $taget_dir.$file_name.'.'.$imageFileType;
				
				$image_type = array('jpg','jpge','png','gif');
				if(!in_array($imageFileType, $image_type)) {
					$result['error'] = "Chỉ tải lên các tập tin jpg|png|jpge|gif";
					$success = FALSE; 
				}
				if($_FILES[$input_name]['size'] > 2097152) {
					$result['error'] = "Tập tin tải lên tối đa là 2MB";
					$success = FALSE;
				}
				
				if($success) {
					if(move_uploaded_file($_FILES[$input_name]['tmp_name'], $image_path)) {
						
						$_FILES[$input_name]['file_name'] = $file_name.".".$imageFileType;
						
						$result = $_FILES[$input_name];
					}
				}
			}

		}
		
		return $result;
	}
}