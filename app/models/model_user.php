<?php
class model_user extends MY_Model {
	//public $abc;
	function __construct() {
		parent::__construct('lh_users');
		
	}
	
	
	function default_value() {
		return array(
			'id' => NUll,
            'fullname' => '',
            'username' => '',
            'groups' => '0',
            'image_' => BASE_URL.'assets/backend/img/icons/no_avatar_256x256.png',
            'phone' => '',
            'email' => '',
            'address' => '',
            'gender' => 1,
            'birthday' => '',
            'status' => 1
		);
	}
	
	function conver_data($data = array()) {
		if(isset($data['image'])) {
			$data['image_'] = BASE_URL.'upload/user/'.$data['image'];
		}else $data['image_'] = BASE_URL.'assets/backend/img/icons/no_avatar_256x256.png';
		if(isset($data['gender'])) {
			$data['gender_'] = "{user_gender_".$data['gender']."}";
		}
		if(isset($data['groups'])) {
			$data['groups_'] = "{user_group_".$data['groups']."}";
		}
		$data['status_'] = "{user_status_".$data['status']."}";
		if(isset($data['create_at'])) {
			$data['create_at_'] = date('d-m-Y', $data['create_at']);
		}
		
		return $data;
	
	}

}