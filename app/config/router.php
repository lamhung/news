<?php
/**
	$router['đường dẫn/controller'] = 'thư mục chứa'
**/
function router() {

	$router = array();
	$router['home'] = "frontend";
	$router['acp/home'] = "acp";
	$router["acp/user"] = "acp";

	return $router;
}
?>