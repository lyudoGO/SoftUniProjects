<!-- Front Controller Pattern -->
<?php
session_set_cookie_params(1800, "/");
session_start();

include_once 'includes/config.php';
include_once 'includes/database.php';
include_once 'controllers/BaseController.php';

// Define root path and dir
define('DEFAULT_ROOT_DIR', dirname(__FILE__) . '\\');
define('DEFAULT_ROOT_PATH', basename(dirname(__FILE__)));

$baseController = new \Controllers\BaseController();

// Extract the $controller, $method and $params from the HTTP request
$requestHome = '/' . DEFAULT_ROOT_PATH;
$request = $_SERVER['REQUEST_URI'];
$controllerName = 'Home';
$methodName = 'index';
$components = array();
$parameters = array();

if (!empty($request)) {
	if (strpos($request, $requestHome) === 0) {
		$request = substr($request, strlen($requestHome));
		$components = explode('/', $request);

		if (count($components) > 1) {
			$controllerName = $components[1];
			if (isset($components[2])) {
				$methodName = $components[2];
			}

			if (isset($components[3])) {
				$parameters = array_splice($components, 3);
			}
		}
	}
}

// Load the controller and execute the method
if (isset($controllerName) && file_exists('controllers/' . ucfirst($controllerName) . 'Controller.php')) {
	// If we have controller should load it
	include_once 'controllers/' . ucfirst($controllerName) . 'Controller.php';

	$controllerClass = '\Controllers\\' . ucfirst($controllerName) . 'Controller';

	// Create instance of controllers matched in URL
	$controller = new $controllerClass();

	// Call method and object
	if (method_exists($controller, $methodName)) {
		call_user_func_array(array($controller, $methodName), $parameters);
	} else {
		call_user_func_array(array($controller, 'index'), array());
	}

} else {
	include_once 'controllers/HomeController.php';
	$homeController = new \Controllers\HomeController();
	$homeController->index();
}