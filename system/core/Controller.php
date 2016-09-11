<?php
class Controller {
	/**
	 * -Load view $this->view('tên_thư mục trong views/tên file',$data);
	 	$this->view('backend/layout/header', $data);
	 	$data['ten_bien'] = giá trị;//ten_bien là bien se su dung ơ view	
	 */
	function view($string = '', $data = array()) {
		if($string) {
			if(substr($string, 0, -4) != ".php") {
				$string .= ".php";
			}
			if(file_exists($path = PATH_VIEWS.'/'.$string)) {
				foreach($data as $k => $v) {
					$$k = $v;
				}
				require_once $path;
			} else {
				$error = "Không tìm thấy views <strong>".$path."</strong>";
				die(require_once 'app/views/errors/error_404.php');
			}

		}
	}
	/**
	 * -Load model $this->model('model_user');
	 	model_user : tên file của model 
	 	
	 */
	function model($string = '') {
		if($string) {
			if(substr($string, 0, -4) != ".php") {
				$str = $string.".php";
			}
			if(file_exists($path = PATH_MODELS.'/'.$str)) {
				//require_once $path;
				$this->$string = new $string;
			} else {
				$error = "Không tìm thấy model <strong>".$path."</strong>";
				die(require_once 'app/views/errors/error_404.php');
			}

		}
	}
	/**
	 * -Load libraries $this->library('pagination');$this->library('form_validation',model_user);
	 	-model_user dùng để kết nối vào trong table user để kiểm tra sự tồn tại cải 1 input nào đó.
	 */
	function library($string = '', $data = '') {
		if($string) {
			if(substr($string, 0, -4) != ".php") {
				$filename = 'lib_'.$string;
				$str = $filename.".php";
			}
			if(file_exists($path = PATH_PAGINATION.'/'.$str)) {
				require_once $path;
				$this->$string = new $filename($data);
			} else {
				$error = "Không tìm thấy library ".$filename." <strong> trong ".$path."</strong>";
				die(require_once 'app/views/errors/error_404.php');
			}

		}
	}

	function helper($string = '') {
		if($string) {
			if(substr($string, 0, -4) != ".php") {
				$filename = 'hel_'.$string;
				$str = $filename.".php";
			}
			if(file_exists($path = PATH_HELPER.'/'.$str)) {
				require_once $path;
			} else {
				$error = "Không tìm thấy helper ".$filename." <strong>".$path."</strong>";
				die(require_once 'app/views/errors/error_404.php');
			}

		}
	}

}