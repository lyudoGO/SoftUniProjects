<?php
namespace Controllers;

class CommentsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Comment', 'views\\comments\\');
	}

	public function index(){
		$comments = $this->model->find();
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$comments = $this->model->get($id);
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function playlist($playlist_id) {
		$this->templateFile .= 'add_to_playlist.php';
		include_once $this->layout;

		if (isset($_POST['comment-text'])) {
			$pairs = array(
				'text' => $_POST['comment-text'],
				'playlist_id' => $playlist_id
			);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("Comment added.");
	            $this->redirect('playlists');
	        } else {
	            $this->addErrorMessage("Cannot add comment.");
	        }
		}
	}

	public function song($song_id) {
		$this->templateFile .= 'add_to_song.php';
		include_once $this->layout;

		if (isset($_POST['comment-text'])) {
			$pairs = array(
				'text' => $_POST['comment-text'],
				'song_id' => $song_id
			);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("Comment added.");
	            $this->redirect('playlists');
	        } else {
	            $this->addErrorMessage("Cannot add comment.");
	        }
		}
	}
}