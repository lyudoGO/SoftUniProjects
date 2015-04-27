<!-- Front Controller Pattern -->
<?php
// Define root path and dir
define('/', DIRECTORY_SEPARATOR);
define('ALBUMS_ROOT_DIR', dirname(__FILE__) . '/');
define('ALBUMS_ROOT_PATH', basename(dirname(__FILE__)) . '/');

$request_home = '/' . ALBUMS_ROOT_PATH;

$request = $_SERVER['REQUEST_URI'];
$controller = 'Master';
$method = 'index';
$components = array();
$parameters = array();

include_once 'controllers/master.php';
$master = new \Controllers\Master_Controller();

if (!empty($request)) {
	if (strpos($request, $request_home) === 0) {
		$request = substr($request, strlen($request_home));
		$components = explode('/', $request, 3);

		if (count($components) > 1) {
			list($controller, $method) = $components;

			if (isset($components[2])) {
				$parameters = $components[2];
			}
		}
	}
}

// Check if controller is found
if (strcmp($controller, 'Master') != 0 && file_exists('controllers/' . $controller . '.php')) {
	// If we have new controller should load it
	include_once 'controllers/' . $controller . '.php';

	$controller_class = '\Controllers\\' . ucfirst($controller) . '_Controller';

	// Create instance of controllers matched in URL
	$instance = new $controller_class();

	// Call method and object
	if (method_exists($instance, $method)) {
		call_user_func_array(array($instance, $method), array($parameters));
	} else {
		call_user_func_array(array($instance, 'index'), array());
	}

} else {
	$master->index();
}