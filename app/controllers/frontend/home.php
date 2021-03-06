<?php
class home extends MY_Controller{
	public $model_baiviet;
	public $model_phanloaibai;
	public $c_name="baiviet";
	public $cacloai;
	
	function __construct($action, $params) {
		$this->params = $params;
		$this->current_action = $action;

		$this->model('model_baiviet');
		$this->model('model_phanloaibai');
		//pagination
		$this->library('pagination');

		$dk_cacloai = array(
			'select' => "idloai,TenLoai,Alias",
			'where' => array('lang' => 'vi', 'AnHien'=>'1','idCha' =>'0'),
			'order_by' => 'ThuTu',
		);
		$this->cacloai = $this->model_phanloaibai->get_rows($dk_cacloai);		
	}
	
	function index() {
		$dk_bnb = array(
			'select' => "idbv, TieuDe, urlHinh, TomTat,idLoai, Alias",
			'where' => array('lang' => 'vi', 'AnHien' => '1','NoiBat'=>'1'),
			'order_by' => 'idbv, DESC',
			'limit' => '0, 5'
		);
		$this->data['bainb'] = $this->model_baiviet->get_rows($dk_bnb);
		
		$dk_bxn = array(
			'select' => "idbv, TieuDe, urlHinh, TomTat,Alias,idLoai",
			'where' => array('lang' => 'vi', 'NoiBat' => '1'),
			'order_by' => 'SoLanXem DESC',
			'limit' => '0,10'
		);
		$this->data['baixn'] = $this->model_baiviet->get_rows($dk_bxn);
		$this->view('frontend/layout/header');
		$this->view('frontend/home/index', $this->data);
		$this->view('frontend/layout/footer');
	}
	
	function cat() {
		$alias = $this->params[0];
		$dk_idloai = array(
			'select' => 'idloai',
			'where' => array('Alias' => $alias)
		);
		$idloai = $this->model_phanloaibai->get_by($dk_idloai);
		$idloai = $idloai['idloai'];
		settype($idloai,"int");
		
		if(count($this->params)<=1){
		  $currentpage=1;
	  	}else {$currentpage= $this->params[1];}
		settype($currentpage,"int");
		if ($idloai<=0) return; 
		
		$dk = array(
			'select' => 'idloai',
			'where' => array('idloai' => $idloai),
			'where_or' =>array('idCha' => $idloai),
		);
		$dk_where_in = $this->model_phanloaibai->get_rows($dk);

		$dk_count = array(
			'where' => array('idLoai' =>$idloai, 'AnHien' => '1'),
			'where_in' => array('idLoai' => $dk_where_in)
		);
		$totalrows = $this->model_baiviet->count_rows($dk_count);
		$config = array(
			'base_url' => BASE_URL.$alias.'/trang',
			'total_rows' => $totalrows,
			'per_page' => '5',
			'current_page' => $currentpage,
			'full_tag_open' => "<div id='thanhphantrang'>",
			'full_tag_close' => "</div'>",
			'cur_tag_open' => "<span>",
			'cur_tag_close' => "</span>",
			
		);
		$this->pagination->initialize_pagination($config);

		$startrow = ($currentpage - 1)*$config['per_page'];
		$dk_baitrongloai = array(
			'select' => "idbv,TieuDe, TomTat, urlHinh, Ngay, SoLanXem,Alias",
			'where' => array('idLoai' => $idloai),
			'where_in' => array('idLoai'=> $dk_where_in),
			'order_by' => 'idbv',
			'limit' => "$startrow, ".$config['per_page']
		);
		$this->data['listbai'] = $this->model_baiviet->get_rows($dk_baitrongloai);
		$this->data['alias'] = $alias;
		//print_r($listbai);
		
		$this->view('frontend/layout/header');
		$this->view('frontend/home/index', $this->data);
		$this->view('frontend/layout/footer');
	}
	
	function detail() {
		$alias = $this->params[1];
		$dk_detail = array(
			'select' => "idbv, TieuDe, urlHinh, TomTat, Ngay, SoLanXem, Content,Alias",
			'where' => array('Alias' => $alias)
		);
		$this->data['detail'] = $this->model_baiviet->get_by($dk_detail);

		$this->view('frontend/layout/header');
		$this->view('frontend/home/index', $this->data);
		$this->view('frontend/layout/footer');
	}
	
	
	

}