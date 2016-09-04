<?php
class MY_Model extends Model{
	public $db;
	protected $tables = array();
	protected $table_name = NULL;
	protected $fields = array();
	protected $key = NULL;
	protected $model ;
	
	
	function __construct($table_name) {
		//parent::__construct();
		$this->db = new mysqli(HOST, USER_DB, PASS_DB, DB_NAME);
		$this->db->set_charset('utf8');
		//$this->model = new Model;
		$this->get_table();
		$this->initialize($table_name);
		
		
	}
	/**
     * Lấy ra các table có trong database
    */
	function get_table() {
		$sql = "SHOW tables";
		$query = $this->db->query($sql);
		foreach($query as $rows) {
			foreach($rows as $row) {
				$this->tables[] = $row;
			}
		}
	}
	/**
     * Initialize model
	 *Lấy ra các field có trong 1 table
    */
	function initialize($table_name) {
		if(in_array($table_name,$this->tables )) {
			$this->table_name = $table_name;
			
			$sql = "SHOW COLUMNS FROM $table_name";
			$query = $this->db->query($sql);
			foreach($query as $row) {
				$this->fields[] = $row['Field'];
				if($row['Key'] == 'PRI') {
					$this->key = $row['Field'];
				}
			}
		} else {
			die('Không tồn tại '.$table_name.'</br>'.'SHOW COLUMNS FROM '.$table_name);
		}
	}
	
	/**
     * 
	 *get_rows
	 $input = array(
	 	select => 'string',
		'where' =>'string',
		'and' => 'string'
		'order_by' => 'sring',
		'limit' => 'string'
	 );
	 
	 
	 
    */
	function get_rows($input = array()) {
		$data = array();
		//select
		if(isset($input['select'])) {
			$select = explode(',', $input['select']);
			//print_r($select);
			foreach($select as $v) {
				if(!in_array(trim($v),$this->fields)) {
					die("Table ".$this->table_name." Unknown column <strong>&quot;".$v."&quot;</strong>");
				}
			}
			if(is_string($input['select']) && $input['select']) {
				$sql_select = $input['select'];
			}
		}else {$sql_select = '*';}
		 //where
		if(isset($input['where'])) {
			if(is_string($input['where']) && $input['where']) {
				$sql_where = "WHERE ".$input['where'];
			} 
		}else {$sql_where = '';}
		//where in
		if(isset($input['where_in'])) {
			if(is_array($input['where_in'])) {
				$where_in_select = $input['where_in']['select'] ?$input['where_in']['select'] : "*";
				$where_in_table_name = $input['where_in']['table_name'] ? $input['where_in']['table_name'] : "";
				$where_in_where = $input['where_in']['where'] ? $input['where_in']['where'] : "";
				
				$sql_where_in = "IN (SELECT $where_in_select FROM $where_in_table_name WHERE $where_in_where)";
			} 
		}else {$sql_where_in = '';}		
		
		//order_by
		if(isset($input['order_by'])) {
			if(is_string($input['order_by']) && $input['order_by']) {
				$sql_order_by = "ORDER BY ".$input['order_by'];
			} 
		}else {$sql_order_by = '';}
		//limit
		if(isset($input['limit'])) {
			if(is_string($input['limit']) && $input['limit']) {
				$sql_limit = "LIMIT ".$input['limit'];
			} 
		}else {$sql_limit = '';}
		
		$sql = "SELECT $sql_select FROM $this->table_name $sql_where $sql_where_in $sql_order_by $sql_limit";
		$query = $this->db->query($sql);
		if(!$query) die( $this->db->error."<hr>".$sql);
		foreach($query as $row) {
			$data[] = $row;
		}
		//echo $sql;
		return $data;
	}
	
	function get_by($conditions = array()){
		//where
		//$this->select("fullname, user");
		//$this->where('id','2');
		//$this->get('users');
		//$this->last_query();
		//echo "<br>";


		if(is_numeric($conditions)) {
			$sql_where = "WHERE $this->key = $conditions";
		}
		else if(isset($conditions['where'])){
			$sql_where = "WHERE ".$conditions['where'];
			
		}
		
		//select
		if(isset($conditions['select'])) {
			$select = explode(',', $conditions['select']);
			//print_r($select);
			foreach($select as $v) {
				if(!in_array(trim($v),$this->fields)) {
					die("Table ".$this->table_name." Unknown column <strong>&quot;".$v."&quot;</strong>");
				}
			}
			if(is_string($conditions['select']) && $conditions['select']) {
				$sql_select = $conditions['select'];
			}
		}else {$sql_select = '*';}
		
		$sql = "SELECT $sql_select FROM $this->table_name $sql_where";
		$query = $this->db->query($sql);
		if(!$query) die($this->db->error."<hr>".$sql);
		$row = $query->fetch_assoc();
		
		return $row;
	}
	
	function count_rows($conditions = array()) {
		 //where
		if(isset($conditions['where'])) {
			if(is_string($conditions['where']) && $conditions['where']) {
				$sql_where = "WHERE ".$conditions['where'];
			} 
		}else {$sql_where = '';}
		//where in
		if(isset($conditions['where_in'])) {
			if(is_array($conditions['where_in'])) {
				$where_in_select = $conditions['where_in']['select'] ?$conditions['where_in']['select'] : "*";
				$where_in_table_name = $conditions['where_in']['table_name'] ? $conditions['where_in']['table_name'] : "";
				$where_in_where = $conditions['where_in']['where'] ? $conditions['where_in']['where'] : "";
				
				$sql_where_in = "IN (SELECT $where_in_select FROM $where_in_table_name WHERE $where_in_where)";
			} 
		}else {$sql_where_in = '';}

		$sql = "SELECT count(*) FROM $this->table_name $sql_where $sql_where_in";
		
		$query = $this->db->query($sql);
		if(!$query) die($this->db->error."<hr>".$sql);
		$row = $query->fetch_row();
		return $row[0];

	}
	
	/*insert
		truyen vào post la 1 array
	*/
	function insert($post = array()) {
		$str_select = '';
		$str_val = '';
		if(is_array($post) or count($post) >0) {
			foreach($post as $k => $v) {
				if(in_array($k, $this->fields) && $v != "") {
					$str_select .= ',`'.$k.'`';
					$str_val .=  ",'".addslashes($v)."'";
				}
			}
		}
		$str_select = ltrim($str_select, ',');
		$str_val = ltrim($str_val, ',');
		
		$sql = "INSERT INTO $this->table_name($str_select)  VALUE($str_val)";
		$query = $this->db->query($sql);
		if(!$query) die($this->db->error."<hr>".$sql);
		
		return $query;
	}
	
	function insert_id() {
		return $this->db->insert_id;
	}
	
	
	
}