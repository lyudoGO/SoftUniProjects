<?php
namespace Models;

class AccountModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'users'));
	}

	public function register($username, $password, $fullname , $email) {
		$result = $this->find(array('columns' => 'count(id)', 'where' => 'username = "' . $username . '"'));
		if ($result[0]['count(id)']) {
			return false;
		}

		$hashPassword = password_hash($password, PASSWORD_BCRYPT);

		$pairs = array(
				'username' => $username,
				'password' => $hashPassword,
		);
		if (!empty($fullname)) {
			$pairs['fullname'] = $fullname;
		}
		if (!empty($email)) {
			$pairs['email'] = $email;
		}
		
		$register = $this->create($pairs);

		return $register;
	}

	public function login($username, $password) {
		$result = $this->find(array('where' => 'username = "' . $username . '"'));

		if (password_verify($password, $result[0]['password'])) {
			$_SESSION['username'] = $result[0]['username'];
			$_SESSION['user_id'] = $result[0]['id'];
			$_SESSION['is_admin'] = $result[0]['is_admin'];
			return true;
		}

		return false;
	} 

	public function getLoggedUser() {
		if (!isset( $_SESSION['username'])) {
			return array();
		}
		
		return array( 
				'username' => $_SESSION['username'], 
				'user_id' => $_SESSION['user_id'] 
		);
		
	}
}