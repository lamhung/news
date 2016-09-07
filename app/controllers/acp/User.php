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
	
	function index() {
		$condition = array(
			'select' => 'id,fullname,username,groups,email,gender,status',
			'order_by' => 'id, DESC',
		);
		$rows = $this->model_user->get_rows($condition);
		$this->data['rows'] = $rows;

		$this->view('app/views/backend/layout/header');
		$this->view("app/views/backend/user/index", $this->data);
		$this->view("app/views/backend/layout/footer");
	}
	function add() {
		$errors = array();
		$row = $this->model_user->default_value();
		$post = array();
		if(isset($_POST['submit'])) {
			$post = $_POST;
			
			$errors = $this->form_validation->set_empty(
				array('fullname', 'username', 'password', 're_password', 'email'),
				array('{user_fullname}','{user_username}','{user_password}','{user_re_password}','{user_email}')
			);
			if(!empty($post['username'])) {
				$errors['username'] = $this->form_validation->row_exist('username','{user_username}');
				if($errors['username'] == '') unset($errors['username']);
			}
			if(!empty($post['email'])) {
				$errors['email'] = $this->form_validation->row_exist('email','{user_email}');
				if($errors['email'] == '') unset($errors['email']);
			}
			if(isset($post['re_password']) && isset($post['re_password']) && $post['re_password'] != $post['password']){
				$errors['re_password'] = "<span class='text-danger'>{user_re_password} {form_do_not_exactly}</span>";
			}

			if(count($errors) == 0) {
				$success = TRUE;
				if($_FILES['image']['name']) {
					$image = $this->upload->upload_one('image', 'user');

					if($image['error']) {
						$this->data['image_error'] = $image['error'];
						$success = FALSE;
					}else {
						$post['image'] = $image['file_name'];
					}
					
				}
				
				if($success) {
					$post['password'] = md5(md5($post['password']));
					$post['create_at'] = time();
				}	
					
				$ressult = $this->model_user->insert_row($post);
				if($ressult) {
					$id = $this->model_user->insert_id();
					header("location:".BASE_URL."acp/user/show/".$id);
				}
			}
		}

		$this->data['row'] = $row;
		$this->data['error'] = $errors;

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

		$errors = array();
		$post = array();
		if(isset($_POST['submit'])) {
			$post = $_POST;
			
			$errors = $this->form_validation->set_empty(
				array('fullname', 'username', 'email'),
				array('{user_fullname}','{user_username}','{user_email}')
			);
			if(!empty($post['username']) && $post['username'] != $user['username']) {
				$errors['username'] = $this->form_validation->row_exist('username','{user_username}');
				if($errors['username'] == '') unset($errors['username']);
			}
			if(!empty($post['email']) && $post['email'] != $user['email']) {
				$errors['email'] = $this->form_validation->row_exist('email','{user_email}');
				if($errors['email'] == '') unset($errors['email']);
			}
			if(isset($post['re_password']) && isset($post['re_password']) && $post['re_password'] != $post['password']){
				$errors['re_password'] = "<span class='text-danger'>{user_re_password} {form_do_not_exactly}</span>";
			}

			if(count($errors) == 0) {
				$success = TRUE;
				if($_FILES['image']['name']) {
					$image = $this->upload->upload_one('image', 'user');

					if($image['error']) {
						$this->data['image_error'] = $image['error'];
						$success = FALSE;
					}else {
						$post['image'] = $image['file_name'];
						unlink(UPLOAD_PATH.'user/'.$user['image']);
					}
					
				}
				
				if($success) {
					if(isset($post['password'])) {
						$post['password'] = md5(md5($post['password']));
					} else{
						$post['password'] = $user['password'];
					}
					//$post['create_at'] = time();
				}			
				$ressult = $this->model_user->update_row($post);
				if($ressult) {
					header("location:".BASE_URL."acp/user/show/".$id);
				}
			}
		}

		$this->data['error'] = $errors;
		
		$this->view('app/views/backend/layout/header');
		$this->view("app/views/backend/user/edit", $this->data);
		$this->view("app/views/backend/layout/footer");
	}
}