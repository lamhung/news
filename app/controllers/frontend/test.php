<?php
class test extends Controller {
	public $model_baiviet = '';
	function __construct() {
		$this->model_baiviet = new M_baiviet;
	}
	function test() {
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
	}
}