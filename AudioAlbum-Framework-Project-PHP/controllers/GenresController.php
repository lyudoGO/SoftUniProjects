<?php
namespace Controllers;

class GenresController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Genre', '/views/genres/');
	}

	public function index(){
		$genres = $this->modelName->find();
		$templateFile = DEFAULT_ROOT_DIR . $this->viewsDir . 'index.php';
		include_once $this->layout;
	}
}