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
		$this->templateFile .= 'view.php';
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

	public function delete($id) {
		$this->model->setForeignKey();
		if ($this->model->delete($id)) {
			$this->model->setForeignKey();
			$this->addInfoMessage("Comment deleted.");
            $this->redirect('comments');
		} else {
            $this->addErrorMessage("Cannot delete comment.");
        }
	}

	public function edit($id) {
		$comment = $this->model->get($id);
		$model = $comment[0];
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if (isset($_POST['comment-text'])) {
			$model['text'] = $_POST['comment-text'];
			$model['song_id'] = $_POST['song-id'];
			$model['playlist_id'] = $_POST['playlist-id'];
			$model['user_id'] = $_POST['user-id'];
			$this->model->setForeignKey();
			if ($this->model->update($model)) {
				$this->model->setForeignKey();
				$this->addInfoMessage("Comment edited.");
            	$this->redirect('comments');
			} else {
	            $this->addErrorMessage("Cannot edit comment to database.");
	        }
		}
	}
}