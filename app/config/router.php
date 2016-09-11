<?php
/**
	$router['đường dẫn'] = 'thư mục chứa trong controller(nếu có)/controller/action'
	([^/]+) ko lấy dấu /
	(:num) truyền vào params phải là các kí tự số
	(:any) truyền vào params các kí tự trừ dấu /
**/
function router() {
	$router = array();

	$router['default_controller'] = "frontend/home/";

	
	
	//$router['home/cat/(:num)'] = "frontend/home/cat";
	//$router['home/cat/(:num)/(:num)'] = "frontend/home/cat";
	//$router['home/detail/(:num)'] = "frontend/home/detail";

	/**
	 * Backend
	 */
	$router['acp'] = "backend/home";
	
	//*user
	$router["acp/user"] = "backend/user";
	$router["acp/user/page"] = "backend/user/index";
	$router["acp/user/page/(:num)"] = "backend/user/index";
	$router["acp/user/add"] = "backend/user/add";
	$router["acp/user/show/(:num)"] = "backend/user/show";
	$router["acp/user/edit/(:num)"] = "backend/user/edit";
	$router["acp/user/delete/(:num)"] = "backend/user/delete";
	/**
	 * Frontend
	 */
	$router['home'] = "frontend/home";
	$router["(:any).html"] = "frontend/home/cat";
	$router["(:any)/trang"] = "frontend/home/cat";
	$router["(:any)/trang-(:num)"] = "frontend/home/cat";
	$router["(:any)/(:any).html"] = "frontend/home/detail";


	return $router;
}
?>