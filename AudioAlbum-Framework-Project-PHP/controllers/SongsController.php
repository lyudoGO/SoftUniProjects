<?php
namespace Controllers;

class SongsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Song', '/views/songs/');
	}

	public function index(){
		$songs = $this->model->find();
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$songs = $this->model->get($id);
		$this->templateFile .= 'view.php';
		include_once $this->layout;
	}

	public function create() {
		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if (isset($_POST['song-name'])) {
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
		$song = $this->model->get($id);
		$model = $song[0];
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if (isset($_POST['song-name'])) {
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