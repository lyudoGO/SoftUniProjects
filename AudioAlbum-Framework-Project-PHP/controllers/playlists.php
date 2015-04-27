<?php
namespace Controllers;

class Playlists_Controller extends Master_Controller {

	public function __construct(){
		parent::__construct('/views/playlists/');
	}

	public function index(){
		$template_file = ALBUMS_ROOT_DIR . $this->views_dir . 'index.php';
		include_once $this->default_layout;
	}
}