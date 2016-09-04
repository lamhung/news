<?php
class home extends Controller{
	public $model_baiviet;
	public $c_name="baiviet";
	public $cacloai;
	
	function __construct($action, $params) {
		
		$this->model_baiviet = new M_baiviet();
		$this->model_phanloaibai = new M_phanloaibai();
		$this->params = $params;
		$this->current_action = $action;
		//pagination
		require_once("app/libraries/lib_pagination.php");
		$this->pagination = new lib_pagination();
		
		$dk_cacloai = array(
			'select' => "idloai, TenLoai",
			'where' => "lang = 'vi' AND AnHien = 1  AND idcha = 0",
			'order_by' => 'ThuTu',
		);
		$this->cacloai = $this->model_phanloaibai->get_rows($dk_cacloai);
		
	}
	function index() {
		$dk_bnb = array(
			'select' => "idbv, TieuDe, urlHinh, TomTat",
			'where' => "lang = 'vi' AND NoiBat = 1",
			'order_by' => 'idbv DESC',
			'limit' => '0,5'
		);
		$bainb = $this->model_baiviet->get_rows($dk_bnb);
		
		$dk_bxn = array(
			'select' => "idbv, TieuDe, urlHinh, TomTat",
			'where' => "lang = 'vi' AND NoiBat = 1",
			'order_by' => 'SoLanXem DESC',
			'limit' => '0,10'
		);
		$baixn = $this->model_baiviet->get_rows($dk_bxn);
		require_once "app/views/frontend/layout/header.php"; 
		require_once "app/views/frontend/home/index.php"; 
		require_once "app/views/frontend/layout/footer.php";
	}
	
	function cat() {
		$idloai = $this->params[0];
		if(count($this->params)<=1){
		  $currentpage=1;
	  	}else {$currentpage= $this->params[1];}
		settype($idloai,"int"); settype($currentpage,"int");
		if ($idloai<=0) return; 
 		if($currentpage<=0) $currentpage=1;
		$per_page=5;
		$dk_count = array('where' => "idloai = $idloai AND AnHien = 1 OR idloai",
							'where_in' => array('select' => 'idloai',
										'table_name' => 'phanloaibai', 
										'where' => "idloai = ".$idloai. " OR idcha = ".$idloai." "
									  )
					);
		$totalrows=$this->model_baiviet->count_rows($dk_count);
		
		$startrow = ($currentpage-1)*$per_page;
		
		$dk_baitrongloai = array(
			'select' => "idbv,TieuDe, TomTat, urlHinh, Ngay, SoLanXem",
			'where' => "idloai = $idloai OR idloai",
			'where_in' => array('select' => 'idloai',
								'table_name' => 'phanloaibai', 
								'where' => "idloai = ".$idloai. " OR idcha = ".$idloai." "
								),
			'order_by' => 'idbv',
			'limit' => "$startrow, $per_page"
		);
		$listbai = $this->model_baiviet->get_rows($dk_baitrongloai);
		
		
		require_once "app/views/frontend/layout/header.php";
		require_once "app/views/frontend/home/index.php";
		require_once "app/views/frontend/layout/footer.php";
	}
	
	function detail() {
		$idbv = $this->params[0];
		settype($idbv,"int"); if ($idbv<=0) return;
		$dk_detail = array(
			'select' => "idbv, TieuDe, urlHinh, TomTat, Ngay, SoLanXem, Content",
			'where' => "idbv = $idbv"
		);
		$detail = $this->model_baiviet->get_by($dk_detail);
		require_once "app/views/frontend/layout/header.php";
		require_once "app/views/frontend/home/index.php";
		require_once "app/views/frontend/layout/footer.php";
	}
	
	

}