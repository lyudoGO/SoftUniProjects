<?php
namespace Controllers;

class PlaylistsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Playlist', 'views\\playlists\\');
	}

	public function index(){
		$playlists = $this->model->find(array());
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$playlists = $this->model->get($id);
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function create() {
		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if (isset($_POST['playlist-name'])) {
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
		if ($this->model->delete($id)) {
			$this->addInfoMessage("Playlist deleted.");
            $this->redirect('playlists');
		} else {
            $this->addErrorMessage("Cannot delete playlist.");
        }
	}

	public function edit($id) {
		$playlist = $this->model->get($id);
		$model = $playlist[0];
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if (isset($_POST['playlist-name'])) {
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