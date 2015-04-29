<!-- Front Controller Pattern -->
<?php
session_start();
include_once 'includes/config.php';
// Define root path and dir
define('DEFAULT_ROOT_DIR', dirname(__FILE__) . '\\');
define('DEFAULT_ROOT_PATH', basename(dirname(__FILE__)) . '/');

$requestHome = '/' . DEFAULT_ROOT_PATH ;

$request = $_SERVER['REQUEST_URI'];
$controllerName = 'Base';
$methodName = 'index';
$components = array();
$parameters = array();

include_once 'controllers/BaseController.php';
$baseController = new \Controllers\BaseController();

if (!empty($request)) {
	if (strpos($request, $requestHome) === 0) {
		$request = substr($request, strlen($requestHome));
		$components = explode('/', $request);

		if (count($components) > 1) {
			list($controllerName, $methodName) = $components;

			if (isset($components[2])) {
				$parameters = $components[2];
			}
		}
	}
}

// Check if controller is found
if (isset($controllerName) && file_exists('controllers/' . ucfirst($controllerName) . 'Controller.php')) {
	// If we have new controller should load it
	include_once 'controllers/' . ucfirst($controllerName) . 'Controller.php';

	$controllerClass = '\Controllers\\' . ucfirst($controllerName) . 'Controller';

	// Create instance of controllers matched in URL
	$controller = new $controllerClass();

	// Call method and object
	if (method_exists($controller, $methodName)) {
		call_user_func_array(array($controller, $methodName), array($parameters));
	} else {
		call_user_func_array(array($controller, 'index'), array());
	}

} else {
	$baseController->index();
}