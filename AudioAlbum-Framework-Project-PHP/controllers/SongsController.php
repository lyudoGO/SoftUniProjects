<?php
namespace Controllers;

class SongsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Song', '/views/songs/');
	}

	public function index(){
		$songs = $this->modelName->find();
		$templateFile = DEFAULT_ROOT_DIR . $this->viewsDir . 'index.php';
		include_once $this->layout;
	}
}