<?php
function lang() {
$lang = array();

// Common
$lang["hello"] = "Hello";
$lang["update_personal_information"] = "Update Personal Information";
$lang["english"] = "English";
$lang["vietnamese"] = "Vietnamese";
$lang["logout"] = "Logout";

// User
$lang['user_id'] = 'ID user';
$lang['user_fullname'] = 'Fullname';
$lang['user_username'] = 'Username';
$lang['user_password'] = 'Password';
$lang['user_re_password'] = 'Re pasword';
$lang['user_group'] = 'Group';
$lang['user_group_0'] = 'User';
$lang['user_group_1'] = 'Admin';
$lang['user_image'] = 'Image';
$lang['user_phone'] = 'Phone';
$lang['user_email'] = 'Email';
$lang['user_address'] = 'Address';
$lang['user_gender'] = 'Gender';
$lang['user_birthday'] = 'Birthday';
$lang['user_status'] = 'Status';
$lang['user_create_at'] = 'Date created';
$lang['user_gender_0'] = 'Female';
$lang['user_gender_1'] = 'Man';
$lang['user_status_0'] = 'Lock';
$lang['user_status_1'] = 'Active';
$lang['user_list'] = 'Danh sách nhân viên';
$lang['user_add'] = 'Thêm nhân viên';
$lang['user_edit'] = 'Cập nhật nhân viên';
$lang['user_delete'] = 'Xóa nhân viên';
$lang['user_info'] = 'Thông tin nhân viên';
$lang['user_has_been_updated'] = 'Nhân viên đã được cập nhật!';
$lang['user_has_been_deleted'] = 'Nhân viên đã bị xóa!';
$lang['user_has_been_created'] = 'Nhân viên đã được tạo!';
$lang['user_has_been_locked'] = 'Nhân viên đã bị khóa!';
$lang['user_has_been_deny'] = 'Tài khoản không có quyền hạn truy cập!';
$lang['user_not_exist'] = 'Nhân viên không tồn tại trong hệ thống!';
/*
	form_validation
*/
$lang['form_validation_required'] = "not be empty";
$lang['form_validation_exist'] = "existing";
$lang['form_do_not_exactly'] = 'do not exactly';


return $lang;
}