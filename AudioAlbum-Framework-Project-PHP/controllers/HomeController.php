<?php
namespace Controllers;

class HomeController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Home', 'views\\home\\');
	}

	public function index(){
		$playlists = $this->model->find(array('order by' => 'likes', 'desc' => '', 'limit' => 5));
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}
}