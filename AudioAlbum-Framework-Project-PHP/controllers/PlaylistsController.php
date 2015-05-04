<?php
namespace Controllers;

class PlaylistsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Playlist', 'views\\playlists\\');

			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
	}

	public function index($params = null) {
		$this->authorize();

		if ($params != null) {
			$this->page = intval($params) <= PAGE_START ? PAGE_START : intval($params);
		} 
		
		$from = ($this->page - 1) * $this->pageSize;

		$playlists = $this->model->find(array('limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();
		$playlists = $this->model->get($id);
		$songs = $this->model->getWithSongs($id);
		$comments = $this->model->getWithComments($id);
		$this->templateFile .= 'view.php';
		include_once $this->layout;
	}

	public function create() {
		$this->authorize();
		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if ($this->isPost()) {
			$pairs = array('name' => $_POST['playlist-name']);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("Playlist created.");
	            $this->redirect('playlists');
	        } else {
	            $this->addErrorMessage("Cannot create playlist.");
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		if ($this->model->delete($id)) {
			$this->addInfoMessage("Playlist deleted.");
            $this->redirect('playlists');
		} else {
            $this->addErrorMessage("Cannot delete playlist.");
        }
	}

	public function edit($id) {
		$this->authorize();
		$playlist = $this->model->get($id);
		$model = $playlist[0];
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if ($this->isPost()) {
			$model['name'] = $_POST['playlist-name'];
			if ($this->model->update($model)) {
				$this->addInfoMessage("Playlist edited.");
            	$this->redirect('playlists');
			} else {
	            $this->addErrorMessage("Cannot edit playlist.");
	        }
		}
	}

}