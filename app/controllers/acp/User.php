<?php
class user extends  MY_Controller {
	public $model_user;
	function __construct($action, $params) {
		parent::__construct();
		$this->params = $params;
		$this->model_user = new M_user;
		require_once 'app/libraries/lib_form_validation.php';
		require_once 'app/libraries/lib_image.php';
		$this->form_validation = new lib_form_validation('M_user');
		$this->upload = new lib_image();
		require_once ("app/helpers/hel_helper_validation.php");
		
		//$this->model_user->last_query();
	}
	
	
	function add() {
		
		$row = $this->model_user->default_value();
		$post = array();
		if(isset($_POST['submit'])) {
			$post = $_POST;

			$error = $this->form_validation->set_empty(
				array('fullname', 'username', 'password', 're_password', 'email'),
				array('{user_fullname}','{user_username}','{user_password}','{user_re_password}','{user_email}')
			);
			if(!empty($post['username'])) {
				$error['username'] = $this->form_validation->row_exist('username','{user_username}');
				if($error['username'] == '') unset($error['username']);
			}
			if(!empty($post['email'])) {
				$error['email'] = $this->form_validation->row_exist('email','{user_email}');
				if($error['email'] == '') unset($error['email']);
			}
			if(isset($post['re_password']) && isset($post['re_password']) && $post['re_password'] != $post['password']){
				$error['re_password'] = "<span class='text-danger'>{user_re_password} {form_do_not_exactly}</span>";
				$success = FALSE;
			}
			//print_r($error);
			if(count($error) == 0) {
				$success = TRUE;
				if($_FILES['image']['name']) {
					$image = $this->upload->upload_one('image', 'user');
							
					if($image['error']) {
						$image_error = $image['error'];
						$success = FALSE;
					}else {
						$post['image'] = $image['file_name'];
					}
					
				}
				
				if($success) {
					$post['password'] = md5(md5($post['password']));
					$post['create_at'] = time();
				}			
				$ressult = $this->model_user->insert($post);
				if($ressult) {
					$id = $this->model_user->insert_id();
					header("location:".BASE_URL."acp/user/show/".$id);
				}
			}
		}
		$this->data['row'] = $row;

		$this->view('app/views/backend/layout/header');
		$this->view("app/views/backend/user/add", $this->data);
		$this->view("app/views/backend/layout/footer");
	}
	
	function show() {
		
		$id = $this->params[0];
		$user = $this->model_user->get_by($id);
		if(!$user) {
			header("location:".BASE_URL."acp");
		}
		$this->data['row'] = $this->model_user->conver_data($user);
		//$this->model_user->where('id',1);
		//$this->model_user->update('banner', "hi");
		//$this->model_user->last_query();

		$this->view("app/views/backend/layout/header");
		$this->view("app/views/backend/user/show", $this->data);
		$this->view("app/views/backend/layout/footer");
		
	}
	
	function edit() {
		$id = $this->params[0];
		$user = $this->model_user->get_by($id);
		//print_r($user);
		if(!$user) {
			header("location:".BASE_URL."acp");
		}
		$this->data['row'] = $this->model_user->conver_data($user);
		
		$this->view('app/views/backend/layout/header');
		$this->view("app/views/backend/user/edit", $this->data);
		$this->view("app/views/backend/layout/footer");
	}
}