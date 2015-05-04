<?php
namespace Controllers;

class AccountController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Account', 'views\\account\\');
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
			if ($username == null || strlen($username) < 3) {
				$this->addErrorMessage('User name is invalid.');
				$this->redirect('account', 'register');
			}

			$password = $_POST['password'];
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];

			$isRegistered = $this->model->register($username, $password, $fullname, $email);
			if ($isRegistered) {
				//$_SESSION['username'] = $username;
				$this->addInfoMessage('Register successfully!');
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
			$isLoggedIn = $this->model->login($username, $password);//var_dump($isLoggedIn);die;
			if ($isLoggedIn) {
				//$_SESSION['username'] = $username;
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
	
}