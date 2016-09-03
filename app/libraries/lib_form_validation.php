<?php
class lib_form_validation {
	public $model;
	function __construct($model) {
		if($model != NULL) {
			$this->model = new $model;
		}
	}
	function set_empty($fields,$lable) {
		$error = array();
		if(is_array($fields) && is_array($lable))
		{
			$arr = $fields;
			$arr_lable = $lable;
			//print_r($arr_lable);exit;
			foreach($arr as $k => $v) {
				if(empty($_POST[$v])){
					$error[$v] ="<span class='text-danger'>".$arr_lable[$k]." {form_validation_required}<span>";
				}
			}
		}
		if(is_string($fields) && is_string($lable)) {
			$error[$fields] = "<span class='text-danger'>".$lable." {form_validation_required}<span>";
		}
		
		return $error;
	}
	
	function row_exist($field, $lable) {
			$condition = array('select' => $field);
			$result = $this->model->get_rows($condition);
			foreach($result as $row) {
				if(isset($_POST[$field]) && $_POST[$field] !="" && $_POST[$field] == $row[$field]) {
					$error ="<span class='text-danger'>".$lable." {form_validation_exist}<span>";
					return $error;
				}
			}
			
			
	}
	
	
	
	
}