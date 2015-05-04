<?php
namespace Controllers;

class SongsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Song', '/views/songs/');

			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
	}

	public function index($params = null){
		$this->authorize();
		if ($params != null) {
			$this->page = intval($params) <= PAGE_START ? PAGE_START : intval($params);
		} 
		
		$from = ($this->page - 1) * $this->pageSize;
		
		$songs = $this->model->find(array('limit' => $from . ', ' . $this->pageSize));
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();
		$songs = $this->model->get($id); 
		$comments = $this->model->getWithComments($id);
		$this->templateFile .= 'view.php';
		include_once $this->layout;
	}

	public function create() {
		$this->authorize();
		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if ($this->isPost()) {
			$pairs = array(
				'name' => $_POST['song-name'],
				'artist' => $_POST['artist-name'],
				'duration' => $_POST['duration'],
			);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("Song created.");
	            $this->redirect('songs');
	        } else {
	            $this->addErrorMessage("Cannot create song.");
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		$this->model->setForeignKey();
		if ($this->model->delete($id)) {
			$this->model->setForeignKey();
			$this->addInfoMessage("Song deleted.");
            $this->redirect('songs');
		} else {
            $this->addErrorMessage("Cannot delete song.");
        }
	}

	public function edit($id) {
		$this->authorize();
		$song = $this->model->get($id);
		$model = $song[0];
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if ($this->isPost()) {
			$model['name'] = $_POST['song-name'];
			$model['artist'] = $_POST['artist'];
			$model['duration'] = $_POST['duration'];

			if ($this->model->update($model)) {
				$this->addInfoMessage("Song edited.");
            	$this->redirect('songs');
			} else {
	            $this->addErrorMessage("Cannot edit song.");
	        }
		}
	}
}