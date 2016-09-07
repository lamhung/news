<?php
class MY_Model extends Model{
	public $db;
	protected $tables = array();
	protected $table_name = NULL;
	protected $fields = array();
	protected $key = NULL;
	protected $model ;
	
	
	function __construct($table_name) {
		parent::__construct();
		//$this->db = new mysqli(HOST, USER_DB, PASS_DB, DB_NAME);
		//$this->db->set_charset('utf8');
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
				$this->select($input['select']);	
				//$sql_select = $input['select'];
			}
		}
		 //where
		//echo $input['where'];
		if(isset($input['where'])) {
			 if(is_array($input['where']) && $input['where']) {
			 	foreach ($input['where'] as $f => $c) {
			 		if(in_array(trim($f), $this->fields)) {
				 		$this->where($f, $c);
				 	} else {
				 		die("Table ".$this->table_name." Unknown column <strong>&quot;".$f."&quot;</strong> in condition 'where'  function get_rows()");
				 	}
			 	}
			 	
			 }
		}
		//where_or
		if(isset($input['where_or'])) {
			if(is_array($input['where_or']) && $input['where_or']) {
			 	foreach ($input['where_or'] as $a => $b) {
			 		if(in_array(trim($a), $this->fields)) {
				 		$this->where_or($a, $b);
				 	} else {
				 		die("Table ".$this->table_name." Unknown column <strong>&quot;".$a."&quot;</strong> in condition 'where_or'  function get_rows()");
				 	}
			 	}
			 	
			}
		}
		//where in

		if(isset($input['where_in'])) {
			if(is_array($input['where_in']) && $input['where_in']) {
				foreach ($input['where_in'] as $e => $d) {
					if(is_array($d)) {
						foreach ($d as $v_d) {
							if(!is_array($v_d)) {
								$con_d = $d;
							} else {
								foreach ($v_d as $v_v_d) {
									$con_d[] = $v_v_d;
								}
							}
						}
					}					
			 		if(in_array(trim($e), $this->fields)) {
			 			if(is_array($con_d)) {
					 		$this->where_in($e, $con_d);
					 	}
					} 
			 	}
			}
		}
		//order_by
		if(isset($input['order_by'])) {
			$or =  explode(',',$input['order_by']);
			if(is_string($input['order_by']) && $input['order_by']) {
				$c_or = isset($or[1]) ? $or[1] : "";
				$this->order_by($or[0], $c_or);
			} 
		}
		//limit
		if(isset($input['limit'])) {
			$l = explode(',',$input['limit']);
			if(is_string($input['limit']) && $input['limit']) {
				$this->limit($l[0], $l[1]);
			} 
		}
		
		$this->get($this->table_name);
		//$this->last_query();
		$result = $this->array_result();
		
		return $result;
	}
	
	function get_by($conditions = array()){

		 //where
		if(is_numeric($conditions)) {
			$this->where($this->key, $conditions);
		}
		else if(isset($conditions['where'])) {
				if(is_array($conditions['where']) && $conditions['where']) {
				 	foreach ($conditions['where'] as $f => $c) {
				 		if(in_array(trim($f), $this->fields)) {
					 		$this->where($f, $c);
					 	} else {
				 		die("Table ".$this->table_name." Unknown column <strong>&quot;".$f."&quot;</strong> in condition 'where_or'  function get_by()");
				 		}
				}
				 	
			}
		}
		
		//select
		if(isset($conditions['select'])) {
			$select = explode(',', $conditions['select']);
			//print_r($select);
			foreach($select as $v) {
				if(!in_array(trim($v),$this->fields)) {
					die("Table ".$this->table_name." Unknown column <strong>&quot;".$v."&quot;</strong> in condition 'select' function get_by()");
				}
			}
			if(is_string($conditions['select']) && $conditions['select']) {
				$this->select($conditions['select']);	
				//$sql_select = $input['select'];
			}
		}
		
		$query = $this->get($this->table_name);
		//$this->last_query();
		$result = $this->row_result();

		return $result;
	}
	
	function count_rows($input = array()) {
		 //where
		if(isset($input['where'])) {
			 if(is_array($input['where']) && $input['where']) {
			 	foreach ($input['where'] as $f => $c) {
			 		if(in_array(trim($f), $this->fields)) {
				 		$this->where($f, $c);
				 	} else {
				 		die("Table ".$this->table_name." Unknown column <strong>&quot;".$f."&quot;</strong> in condition 'where' function count()");
				 	}
			 	}
			 	
			 }
		}
		//where_or
		if(isset($input['where_or'])) {
			if(is_array($input['where_or']) && $input['where_or']) {
			 	foreach ($input['where_or'] as $a => $b) {
			 		if(in_array(trim($a), $this->fields)) {
				 		$this->where_or($a, $b);
				 	} else {
				 		die("Table ".$this->table_name." Unknown13 column <strong>&quot;".$a."&quot;</strong> in condition 'where_or' function count_rows()");
				 	}
			 	}
			 	
			}
		}
		//where in
		if(isset($input['where_in'])) {
			if(is_array($input['where_in']) && $input['where_in']) {
				foreach ($input['where_in'] as $e => $d) {
			 		if(is_array($d)) {
						foreach ($d as $v_d) {
							if(!is_array($v_d)) {
								$con_d = $d;
							} else {
								foreach ($v_d as $v_v_d) {
									$con_d[] = $v_v_d;
								}
							}
						}
					}					
			 		if(in_array(trim($e), $this->fields)) {
			 			if(is_array($con_d)) {
					 		$this->where_in($e, $con_d);
					 	}
					} 
			 	}
			}
		}

		$this->count_all($this->table_name);
		//$this->last_query();
		$result = $this->row_result();

		return $result['COUNT(*)'];
	}
	
	/*insert
		truyen vào post la 1 array
	*/
	function insert_row($post = array()) {
		$data = array();
		if(is_array($post) or count($post) >0) {
			foreach($post as $k => $v) {
				if(in_array($k, $this->fields) && $v != "") {
					$data[$k] = $v;
				}
			}
		}
		$query = $this->insert($this->table_name, $data);
		//$this->last_query();
		return $query;
	}

	function update_row($post = array()) {
		$data = array();
		 //where
		if(isset($post[$this->key]) && $post[$this->key] = "") {
			$this->where($this->key, $post[$this->key]);
		}

		if(is_array($post) or count($post) >0) {
			foreach($post as $k => $v) {
				if(in_array($k, $this->fields)) {
					$data[$k] = $v;
				}
			}
		}
		//print_r($data);exit;
		$query = $this->update($this->table_name, $data);
		//$this->last_query();exit;
		return $query;
	}
	
	function insert_id() {
		return $this->db->insert_id;
	}
	
	
	
}