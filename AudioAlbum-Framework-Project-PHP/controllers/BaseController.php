<?php
namespace Controllers;

class BaseController {

	protected $layout;
	protected $viewsDir;
	protected $templateFile;
    protected $parameters;
    protected $filter;
    protected $page;
    protected $pageSize;
    protected $activeClass;

	public function __construct($className = '\Controllers\BaseController',
								$modelName = 'Base',
								$viewsDir = 'views\\home\\') {
        
		$this->viewsDir = $viewsDir;
		$this->className = $className;
        $this->parameters = array();
        $this->filter = '';
        $this->activeClass = '';
		$this->layout = DEFAULT_ROOT_DIR . 'views\\layouts\\default.php';
		$this->templateFile = DEFAULT_ROOT_DIR . $this->viewsDir;

		include_once DEFAULT_ROOT_DIR . "models\\{$modelName}Model.php";
		$modelClass = '\Models\\' . $modelName . 'Model';

		$this->model = new $modelClass(array('table' => 'none'));
	}

	public function index() {
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function redirect($controllerName = null, $methodName = null, $params = null) {
	
        $url = '/' . DEFAULT_ROOT_PATH . '/' . urlencode($controllerName);
        if ($methodName != null) {
        	$url .= '/' . urlencode($methodName);
        }
        if ($params != null) {
        	$encodedParams = array_map('urlencode', $params);
            $paramsJoined = implode('/', $encodedParams);
        	$url .= '/' . urlencode($paramsJoined);
        }

        header("Location: $url");
        die;
	}

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isLoggedIn() {
        if (isset($_SESSION['username'])) {
            return true;
        }

        return false;
    }

    protected function isAdmin() {
        if (isset($_SESSION['username']) && isset($_SESSION['is_admin'])) {
            if ($_SESSION['is_admin'] == 1) {
                return true;
            }
        }

        return false;
    }

    protected function authorize() {
        if (!$this->isLoggedIn()) {
            $this->addErrorMessage('Please, login first');
            $this->redirect("account", "login");
        }
    }

    protected function isValideUsername($username) {
        return (bool) preg_match('/^([-a-z0-9_-])+$/i', $username);
    }

    protected function isValideEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

	public function addErrorMessage($errorMsg) {
        if (!isset($_SESSION['errorMessages'])) {
            $_SESSION['errorMessages'] = [];
        }
        array_push($_SESSION['errorMessages'], $errorMsg);
    }

    public function addInfoMessage($infoMsg) {
        if (!isset($_SESSION['infoMessages'])) {
            $_SESSION['infoMessages'] = [];
        }
        array_push($_SESSION['infoMessages'], $infoMsg);
    }

}