<?php
class Home extends Controller{
	
	
	function __construct() {
		
	}
	
	function index() {
		if(isset($_POST['language'])) echo $_POST['language'];
		
		require_once "app/views/backend/layout/header.php";
		require_once "app/views/backend/layout/footer.php";
	}
}