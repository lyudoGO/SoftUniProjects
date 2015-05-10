<?php
namespace Controllers;

class AccountController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Account', 'views\\account\\');

		$this->activeClass = 'account';
	}

	public function register(){
		if ($this->isLoggedIn()) {
			$this->addErrorMessage('You are registered.');
			$this->redirect('home');
		}

		$this->templateFile .= 'register.php';
		include_once $this->layout;

		if ($this->isPost()) {
			$username = $_POST['username'];
			if (!$this->isValideUsername($username) || strlen($username) < 3 || strlen($username) > 10) {
				$this->addErrorMessage('User name is invalid.Should be betewen 3 and 10 symbols in set { a - z, 0 - 9, -, _  }');
				$this->redirect('account', 'register');
			}

			$password = $_POST['password'];
			if (strlen($password) < 3) {
				$this->addErrorMessage('Password is invalid.Should be at least 3 symbols.');
				$this->redirect('account', 'register');
			}

			$email = $_POST['email'];			
			if ($email != null && !$this->isValideEmail($email)) {
				$this->addErrorMessage('Email is invalid.');
				$this->redirect('account', 'register');
			}
			
			$fullname = $_POST['fullname'];
			if ($fullname != null && strlen($fullname) < 3) {
				$this->addErrorMessage('Fullname is invalid.Should be at least 3 symbols.');
				$this->redirect('account', 'register');
			}

			$isRegistered = $this->model->register($username, $password, $fullname, $email);
			if ($isRegistered) {
				$this->model->login($username, $password);
				$this->addInfoMessage('Register successfully and logged in!');
				$this->redirect('playlists');
			} else {
				$this->addErrorMessage('Register failed!');
				$this->redirect('account', 'register');
			}
		}
	}

	public function login(){
		if ($this->isLoggedIn()) {
			$this->addErrorMessage('You are logged in.');
			$this->redirect('home');
		}

		$this->templateFile .= 'login.php';
		include_once $this->layout;

		if ($this->isPost()) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$isLoggedIn = $this->model->login($username, $password);
			if ($isLoggedIn) {
				$this->addInfoMessage('Successfull login.');
				$this->redirect('playlists');
			} else {
				$this->addErrorMessage('Error login.');
				$this->redirect('account', 'login');
			}
		}
	}

	public function logout() {
		$this->authorize();
		session_destroy();
		//unset($_SESSION['username']);
		$this->addInfoMessage('Successfully logout.');
		$this->redirect('home');
	}

	public function edit() {
		$this->authorize();
		$user = $this->model->getLoggedUser();

		$this->templateFile .= 'index.php';
		include_once $this->layout;
		
		if ($this->isPost()) {
			$model['id'] = $user['user_id'];

			$model['username'] = $_POST['username'];
			if (!$this->isValideUsername($model['username']) || strlen($model['username']) < 3 || strlen($model['username']) > 10) {
				$this->addErrorMessage('User name is invalid.Should be betewen 3 and 10 symbols in set { a - z, 0 - 9, -, _  }');
				$this->redirect('account', 'edit');
			}

			$password = $_POST['password'];
			if (strlen($password) < 3) {
				$this->addErrorMessage('Password is invalid.Should be at least 3 symbols.');
				$this->redirect('account', 'edit');
			}

			$model['password'] = password_hash($password, PASSWORD_BCRYPT);

			if (isset($_POST['fullname'])) {
				$model['fullname'] = $_POST['fullname'];
				if ($model['fullname'] != null && strlen($model['fullname']) < 3) {
					$this->addErrorMessage('Fullname is invalid.Should be at least 3 symbols.');
					$this->redirect('account', 'edit');
				}
			}

			if (isset($_POST['email'])) {
				$model['email'] = $_POST['email'];
				if ($model['email'] != null && !$this->isValideEmail($model['email'])) {
					$this->addErrorMessage('Email is invalid.');
					$this->redirect('account', 'edit');
				}
			}

			if ($this->model->update($model)) {
				$this->addInfoMessage("User account edited.");
            	$this->redirect('home');
			} else {
	            $this->addErrorMessage("Cannot edit user account.");
	            $this->redirect('home');
	        }
		}
	}	
}