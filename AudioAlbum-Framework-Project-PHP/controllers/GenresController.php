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

	public function view($id) {
		$genres = $this->model->get($id);
		$this->templateFile .= 'view.php';
		include_once $this->layout;
	}

	public function create() {
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
		if ($this->model->delete($id)) {
			$this->addInfoMessage("Genre deleted.");
            $this->redirect('genres');
		} else {
            $this->addErrorMessage("Cannot delete genre.");
        }
	}

	public function edit($id) {
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