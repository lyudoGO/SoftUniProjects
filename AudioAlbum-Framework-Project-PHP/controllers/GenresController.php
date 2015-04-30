<?php
namespace Controllers;

class GenresController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Genre', '/views/genres/');
	}

	public function index(){
		$genres = $this->model->find();
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}
}