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
}