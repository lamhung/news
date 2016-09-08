<?php
class lib_pagination {
	protected $base_url = '';
	protected $total_rows = '';
	protected $totalpages = '';
	protected $offset = '';
	protected $per_page = '';
	protected $current_page = '';
	protected $full_tag_open = '';
	protected $full_tag_close = '';
	protected $cur_tag_open = '';
	protected $cur_tag_close = '';
	protected $tag_open = '';
	protected $tag_close = '';
	protected $tag_page_open = '';
	protected $tag_page_close = '';

	function initialize_pagination($config = array()) {
		$this->base_url = isset($config['base_url']) ? $config['base_url'] : "";//đương dẫn đến trang
		$this->total_rows = isset($config['total_rows']) ? $config['total_rows'] : 0;//tổng số sản phẩm
		$this->per_page = isset($config['per_page']) ? $config['per_page'] : 0;//số sản phẩm trên 1 trang
		$this->current_page = isset($config['current_page']) ? $config['current_page'] : 1;//trang hiện tại
		$this->full_tag_open = isset($config['full_tag_open']) ? $config['full_tag_open'] : "";//Trang bao ngoài phân trang
		$this->full_tag_close = isset($config['full_tag_close']) ? $config['full_tag_close'] : "";
		$this->cur_tag_open = isset($config['cur_tag_open']) ? $config['cur_tag_open'] : "";//Trang hiện taij
		$this->cur_tag_close = isset($config['cur_tag_close']) ? $config['cur_tag_close'] : "";
		$this->tag_open = isset($config['tag_open']) ? $config['tag_open'] :"";//tang cho Number $i
		$this->tag_close = isset($config['tag_close']) ? $config['tag_close'] : "";
		$this->tag_page_open = isset($config['tag_page_open']) ? $config['tag_page_open'] :"";//tag pager
		$this->tag_page_close = isset($config['tag_page_close']) ? $config['tag_page_close'] : "";
		$this->offset = isset($config['offset']) ? $config['offset'] : 4;//số trang hiển thị
	}

	function pageslist() {
		$totalpages = ceil($this->total_rows/$this->per_page);

		$from = $this->current_page - $this->offset > 0 ? $this->current_page - $this->offset : 1;
		$to = $this->current_page + $this->offset < $totalpages ? $this->current_page + $this->offset : $totalpages;
		$page_pre = $this->current_page - 1;
		$page_nex = $this->current_page + 1;
		$link = '';
		if($totalpages > 1) {
				$link .= $this->full_tag_open;
			if($this->current_page>1 && $this->tag_page_open != "" && $this->tag_page_close != "") {
					$link .= $this->tag_page_open."<a href='$this->base_url'>&lt;</a>".$this->tag_page_close;
			}
			for($i = $from ;$i <= $to; $i++) {
				if($i == $this->current_page) $link = $link.$this->cur_tag_open.$i.$this->cur_tag_close;
				else{
					$link .=$this->tag_open."<a href='$this->base_url/$i'>".$i."</a>".$this->tag_close;
				}
			}
			if($this->current_page<$totalpages && $this->tag_page_open != "" && $this->tag_page_close != "") {
				$link .= $this->tag_page_open."<a href='$this->base_url/".$totalpages."'>&gt</a>".$this->tag_page_close;
			}
				$link .= $this->full_tag_close;

			return $link;
		}
	}
}
/**
 * 
 Gọi thư viện phân trang trong controller $a = new lib_pagination;
 gọi hàm $a->initialize_pagination()
 Truyền vào các tham số trong initialize_pagination
 --Trong views echo hàm $a->pageslist();
 */