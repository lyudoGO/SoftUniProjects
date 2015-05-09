<?php
namespace Controllers;

class GenresController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Genre', '/views/genres/');
			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
			$this->activeClass = 'genres';
	}

	public function index($paramOne = null, $paramTwo = null){
		$this->authorize();

		if ($paramOne != null) {
			$this->page = intval($paramOne) <= PAGE_START ? PAGE_START : intval($paramOne);
		} 
		if ($paramTwo != null) {
			$this->pageSize = $paramTwo;
		}
		
		$from = ($this->page - 1) * $this->pageSize;

		$genres = $this->model->find(array('order by' => 'id', 'limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function search($paramOne = null, $paramTwo = null) {
		$this->authorize();

		if ($this->isPost()) {
			$this->filter = $_POST['genre-name'];
		}
		
		if ($paramOne != null) {
			$this->page = intval($paramOne) <= PAGE_START ? PAGE_START : intval($paramOne);
		} 
		if ($paramTwo != null) {
			$this->pageSize = $paramTwo;
		}


		$from = ($this->page - 1) * $this->pageSize;

		$genres = $this->model->find(array(
										'where' => 'name LIKE \'%' . $this->filter . '%\'', 
										'limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();

		$genres = $this->model->find(array(
									'table' => 'genres g',
									'columns' => 'g.id, g.name, s.id as song_id, s.name as song_name',
									'left join' => 'songs s',
									'on' => 's.genre_id = g.id',
									'where' => 'g.id = ' . $id,
									'order by' => 's.name'));
		
		$this->templateFile .= 'view.php';    
		include_once $this->layout;
	}

	public function create() {
		$this->authorize();

		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if ($this->isPost()) {
			$pairs = array('name' => $_POST['genre-name']);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("Genre created.");
	            $this->redirect('genres');
	        } else {
	            $this->addErrorMessage("Cannot create genre.");
	            $this->redirect('genres');
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can delete it.");
            $this->redirect('genres');
		}

		if ($this->model->delete($id)) {
			$this->addInfoMessage("Genre deleted.");
            $this->redirect('genres');
		} else {
            $this->addErrorMessage("Cannot delete genre.");
            $this->redirect('genres');
        }
	}

	public function edit($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can edit it.");
            $this->redirect('comments');
		}

		$genre = $this->model->get($id);
		$model = $genre[0];
		
		$this->templateFile .= 'edit.php';
		include_once $this->layout;

		if (isset($_POST['genre-name'])) {
			$model['name'] = $_POST['genre-name'];
			if ($this->model->update($model)) {
				array_push($this->parameters, $id);
				$this->addInfoMessage("Genre edited.");
            	$this->redirect('genres', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot edit genre.");
	            $this->redirect('genres', 'view', $this->parameters);
	        }
		}
	}
}