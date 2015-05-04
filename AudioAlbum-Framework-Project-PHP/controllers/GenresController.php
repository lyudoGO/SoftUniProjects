<?php
namespace Controllers;

class GenresController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Genre', '/views/genres/');
			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
	}

	public function index($params = null){
		$this->authorize();
		if ($params != null) {
			$this->page = intval($params) <= PAGE_START ? PAGE_START : intval($params);
		} 
		
		$from = ($this->page - 1) * $this->pageSize;
		
		$songs = $this->model->find();
		$genres = $this->model->find(array('limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();
		$genre = $this->model->get($id);
		$songs = $this->model->getWithSongs($id);

		$this->templateFile .= 'view.php';    
		include_once $this->layout;
	}

	public function create() {
		$this->authorize();
		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if (isset($_POST['genre-name'])) {
			$pairs = array('name' => $_POST['genre-name']);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("Genre created.");
	            $this->redirect('genres');
	        } else {
	            $this->addErrorMessage("Cannot create genre.");
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		if ($this->model->delete($id)) {
			$this->addInfoMessage("Genre deleted.");
            $this->redirect('genres');
		} else {
            $this->addErrorMessage("Cannot delete genre.");
        }
	}

	public function edit($id) {
		$this->authorize();
		$genre = $this->model->get($id);
		$model = $genre[0];
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if (isset($_POST['genre-name'])) {
			$model['name'] = $_POST['genre-name'];
			if ($this->model->update($model)) {
				$this->addInfoMessage("Genre edited.");
            	$this->redirect('genres');
			} else {
	            $this->addErrorMessage("Cannot edit genre.");
	        }
		}
	}
}