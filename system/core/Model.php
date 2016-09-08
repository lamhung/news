<?php
class Model {
	public $db;
	protected $select = "*";
	protected $where = "";
	protected $where_or = "";
	protected $order_by = "";
	protected $limit = "";
	protected $where_in = "";
	protected $query = "";
	
	function __construct() {
		$this->db = new mysqli(HOST, USER_DB, PASS_DB, DB_NAME);
		$this->db->set_charset('utf8');
	}

	function select($field = '*') {
		if(is_string($field)) {
			$this->select = $field;
		}
	}

	function where($field = '', $condition = '') {
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

	function where_or($field = '', $condition = '') {
		if(empty($this->where)) {
			die("Lỗi truy vấn where_or");
		} else {
			$this->where_or .= " OR $field = '$condition'";
		}
	}

	function where_in($field = '', $condition = array()) {
		$arr = '';
		if(is_array($condition)) {
			foreach ($condition as $v) {
				$arr .= ",'".$v."'";
			}
			$arr = trim($arr, ',');
		}
		if(empty($this->where)) {
				$this->where_in = "WHERE $field IN ($arr)";
		} else {
			$this->where_in .= " OR $field IN($arr)";
		}
	}

	function order_by($field = '', $condition = '') {
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
	

	function get($table = '') {
		$this->query = "SELECT $this->select FROM $table $this->where $this->where_or $this->where_in $this->order_by $this->limit";
	}

	function count_all($table) {
		$this->query = "SELECT COUNT(*) FROM $table $this->where $this->where_or $this->where_in $this->order_by";		
	}

	function insert($table = '', $data = array()) {
		//echo "insert";
		$str_select = '';
		$str_val = '';
		if(is_array($data) AND count($data) != 0) {
			foreach ($data as $key => $value) {
				if($value != '') {
					$str_select .= ",`".$key."`";
					$str_val .= ",'".addslashes(htmlspecialchars($value))."'";
				}
			}	
		}
		$str_select = trim($str_select, ',');
		$str_val = trim($str_val, ',');
		
		$this->query = "INSERT INTO $table($str_select) VALUES($str_val)";
		if(!$result = $this->db->query($this->query)) die($this->db->error."<hr>".$this->query);
		$this->query = '';

		return $result;
		
	}

	function update($table = '', $data = array()){
		$str_data = '';
		$this->query = '';
		if(is_array($data) AND count($data) != 0) {
			foreach ($data as $key => $value) {
				$str_data .=",".$key."='".$value."'";
			}	
		}
		$str_data = trim($str_data, ',');
		$this->query = "UPDATE $table SET $str_data $this->where";
		if(!$result = $this->db->query($this->query)) die($this->db->error."<hr>".$this->query);
		//$this->query = '';

		return $result;
	}

	function delete($table = '') {
		$this->query = "DELETE FROM $table $this->where";
		if(!$result = $this->db->query($this->query)) die($this->db->error."<hr>".$this->query);
		//$this->query = '';

		return $result;
	}

	function last_query() {
	 	if(!empty($this->query)){
	 		echo $this->query;
	 	}
	}

	function query($sql = '') {
		$data = array();
		$query = $this->db->query($sql);
		if(!$query) die($this->db->error."<hr>".$sql);
		foreach ($query as $row) {
			$data[] = $row;
		}

		return $data;
	}

	function array_result() {
		$data = array();
		$result = $this->db->query($this->query);
		if(!$result) die($this->db->error."<hr>".$this->query);
		foreach ($result as $row) {
			$data[] = $row;
		}
		$this->delete_memory();

		return $data;
	}

	function row_result() {
		$data = array();
		$result = $this->db->query($this->query);
		if(!$result) die($this->db->error."<hr>".$this->query);
		$row = $result->fetch_assoc();
		$this->delete_memory();

		return $row;
	}
	function delete_memory() {
		$this->select = "*";
		$this->where = "";
		$this->where_or = "";
		$this->order_by = "";
		$this->limit = "";
		$this->where_in = "";
		$this->query = "";
	}

	function __destruct() {
		$this->db->close();
	}

	
}