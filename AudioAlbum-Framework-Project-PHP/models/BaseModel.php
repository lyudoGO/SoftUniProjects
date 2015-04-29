<?php
namespace Models;

class BaseModel {

	protected $table;
	protected $where;
	protected $columns;
	protected $limit;
	protected static $db;

	public function __construct($args = array()) {
		$args = array_merge( array(
			'where' => '',
			'columns' => '*',
			'limit' => 0
		), $args );

		if (!isset($args['table'])) {
			die('Table not defined.');
		}

		extract($args);
		
		$this->table = $table;
		$this->where = $where;
		$this->columns = $columns;
		$this->limit = $limit;

		if (self::$db == null) {
            self::$db = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (self::$db->connect_errno) {
                die('Cannot connect to database');
            }
        }
	}

	public function get($id) {
		$results = $this->find(array('where' => 'id=' . $id));
		
		return $results;
	}

	public function find( $args = array() ) {
		$args = array_merge( array(
			'table' => $this->table,
			'where' => '',
			'columns' => '*',
			'limit' => 0
		), $args );
		
		extract($args);
		
		$query = "SELECT {$columns} FROM {$table}";
		
		if(!empty($where)) {
			$query .= ' where ' . $where;
		}
		
		if(!empty($limit)) {
			$query .= ' limit ' . $limit;
		}
		
		$resultSet = self::$db->query($query);
		
		$results = $this->processResults($resultSet);
		
		return $results;
	}

	public function create($pairs) {
		// Get keys and values separately
		$keys = array_keys($pairs);
		$values = array();
		
		// Escape values, like prepared statement
		foreach($pairs as $key => $value) {
			$values[] = "'" . self::$db->real_escape_string($value) . "'";	
		}
		
		$keys = implode($keys, ',');
		$values = implode($values, ',');
		
		$query = "INSERT INTO {$this->table}($keys) VALUES($values)";
	
		self::$db->query($query);
		
		return self::$db->affected_rows;
	}

	protected function processResults($resultSet) {
		$results = array();
		
		if(!empty($resultSet) && $resultSet->num_rows > 0) {
			while($row = $resultSet->fetch_assoc()) {
				$results[] = $row;
			}
		}
		
		return $results;
	}
}