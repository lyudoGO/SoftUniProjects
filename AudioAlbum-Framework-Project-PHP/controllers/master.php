<?php
namespace Controllers;

class Master_Controller {

	protected $default_layout;

	protected $views_dir;

	public function __construct($views_dir = '/views/master/') {
		$this->views_dir = $views_dir;
		$this->default_layout = ALBUMS_ROOT_DIR . '/views/default.php';
	}

	public function index() {
		$template_file = ALBUMS_ROOT_DIR . $this->views_dir . 'index.php';
		include_once $this->default_layout;
	}
}