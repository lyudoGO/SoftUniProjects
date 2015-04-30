<?php
namespace Includes;

class Database {
	
	private static $db = null;
	
	private function __construct() {
		// Read the config.php db settings
		$host = DB_HOST;
		$username = DB_USERNAME;
		$password = DB_PASSWORD;
		$database = DB_NAME;
		
		$db = new \mysqli($host, $username, $password, $database);
		
		self::$db = $db;
	}
	
	public static function getInstance() {
		static $instance = null;
		
		if($instance === null) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public static function getDb() {
		return self::$db;
	}
}