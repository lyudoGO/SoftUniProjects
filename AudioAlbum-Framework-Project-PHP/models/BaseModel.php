<?php
namespace Models;

use \Includes\Database;

class BaseModel {

	protected $table;
	protected $db;

	public function __construct($args = array()) {

		if (!isset($args['table'])) {
			die('Table not defined.');
		}

		extract($args);
		
		$this->table = $table;

		$dbInstance = Database::getInstance();
		$this->db = $dbInstance::getDb();
		if ($this->db->connect_errno) {
			die('Cannot connect to database.Error: ' . mysqli_connect_errno());
		}
	}

	public function get($id) {
		$results = $this->find(array('where' => 'id=' . $id));
		
		return $results;
	}

	public function find($args = array()) {
		$args = array_merge( array(
			'table' => $this->table,
			'columns' => '*',
		), $args );
		
		extract($args);

		$query = "SELECT {$columns} FROM {$table}";

		foreach ($args as $key => $value) {
			if(!empty($key) && $key !== 'table' && $key !== 'columns') {
				$query .= ' ' . strtoupper($key) . ' ' . $value;
			}
		}

		$resultSet = $this->db->query($query);//var_dump($query);
		
		$results = $this->processResults($resultSet);

		return $results;
	}

	public function create($pairs) {
		// Get keys and values separately
		$keys = array_keys($pairs);
		$values = array();
		
		// Escape values, like prepared statement
		foreach($pairs as $key => $value) {
			$values[] = "'" . $this->db->real_escape_string($value) . "'";	
		}
		
		$keys = implode($keys, ',');
		$values = implode($values, ',');
		
		$query = "INSERT INTO {$this->table}($keys) VALUES($values)";
	
		$this->db->query($query);
		
		return $this->db->affected_rows > 0;
	}

	public function delete($id) {
		$query = "DELETE FROM {$this->table} WHERE id=" . intval($id);
		
		$this->db->query($query);
		
		return $this->db->affected_rows > 0;
	}

	public function update($model) {
		$query = "UPDATE " . $this->table . " SET ";
		
		foreach($model as $key => $value) {
			if($key === 'id') {
				continue;
			}
			$query .= "$key = '" . $this->db->real_escape_string($value) . "',"; 
		}
		$query = rtrim($query, ",");
		$query .= " WHERE id = " . $model['id'];
		$this->db->query($query);//var_dump($query);
		
		return $this->db->affected_rows > 0;
	}

	public function processResults($resultSet) {
		$results = array();
		
		if(!empty($resultSet) && $resultSet->num_rows > 0) {
			while($row = $resultSet->fetch_assoc()) {
				$results[] = $row;
			}
		}
		
		return $results;
	}
}