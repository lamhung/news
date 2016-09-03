<?php
class Model {
	protected $select = "*";
	protected $where = "";
	protected $where_or = "";
	protected $order_by = "";
	protected $limit = "";
	protected $query = "";
	

	function select($field) {
		$this->select = $field;
	}

	function where($field, $condition) {
		if(isset($field) && isset($condition)) {
			if(empty($this->where)) {
				$this->where = "WHERE $field = '$condition'";
			} else {
				$this->where .= " AND $field = '$condition'";
			}
		} else {
			die("Phải truyền đủ 2 tham số cho where" );
		}
	}

	function where_or($field, $condition) {
		if(empty($this->where)) {
			die("Lỗi truy vấn where_or");
		} else {
			$this->where_or .= " OR $field = '$condition'";
		}
	}

	function order_by($field, $condition = '') {
		if(isset($field)) {
			if(empty($condition)) {
				$this->order_by = "ORDER BY $field";
			} else {
				$this->order_by = "ORDER BY $field $condition";
			}
		}
	}

	function limit($start, $offset) {
		settype($start, 'int');
		settype($offset, 'int');
		if(is_int($start) && is_int($offset)) {
			$this->limit = "LIMIT $start, $offset";
		}
	}

	function get($table) {
		$this->query = "SELECT $this->select FROM $table $this->where $this->where_or $this->order_by $this->limit";
		//echo $query;
	}

	function count_all($table) {
		$this->query = "SELECT COUNT(*) FROM $table $this->where $this->where_or $this->order_by";

	}
	
	function update($table, $data){
		$this->query = "UPDATE $table SET $data $this->where";
	}

	function last_query() {
	 	if(!empty($this->query)){
	 		echo $this->query;
	 	}
	}

	
}