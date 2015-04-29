<?php
namespace Controllers;

class BaseController {

	protected $layout;
	protected $viewsDir;

	public function __construct($className = '\Controllers\BaseController',
								$modelName = 'Base',
								$viewsDir = 'views\\home\\') {
		$this->viewsDir = $viewsDir;
		$this->className = $className;
		$this->layout = DEFAULT_ROOT_DIR . 'views\\layouts\\default.php';

		include_once DEFAULT_ROOT_DIR . "models\\{$modelName}Model.php";
		$modelClass = '\Models\\' . $modelName . 'Model';

		$this->modelName = new $modelClass(array('table' => 'none'));
	}

	public function index() {
		$templateFile = DEFAULT_ROOT_DIR . $this->viewsDir . 'index.php';
		include_once $this->layout;
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