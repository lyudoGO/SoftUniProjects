<?php
namespace Controllers;

class CommentsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Comment', 'views\\comments\\');
			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
			$this->activeClass = 'commnets';
	}

	public function index($params = null){
		$this->authorize();
		if ($params != null) {
			$this->page = intval($params) <= PAGE_START ? PAGE_START : intval($params);
		} 
		
		$from = ($this->page - 1) * $this->pageSize;
		
		$songs = $this->model->find();
		$comments = $this->model->find(array('limit' => $from . ', ' . $this->pageSize));

		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();

		$result = $this->model->getJoinedAll($id);
		$comment = $result[0];

		$this->templateFile .= 'view.php';
		include_once $this->layout;
	}

	public function playlist($playlist_id) {
		$this->authorize();

		$this->templateFile .= 'add_to_playlist.php';
		include_once $this->layout;

		if (isset($_POST['comment-text'])) {
			$pairs = array(
				'text' => $_POST['comment-text'],
				'playlist_id' => $playlist_id,
				'user_id' => $_SESSION['user_id']
			);
			if ($this->model->create($pairs)) {
				array_push($this->parameters, $playlist_id);
	            $this->addInfoMessage("Comment added.");
	            $this->redirect('playlists', 'view', $this->parameters);
	        } else {
	            $this->addErrorMessage("Cannot add comment.");
	            $this->redirect('playlists', 'view', $this->parameters);
	        }
		}
	}

	public function song($song_id) {
		$this->authorize();

		$this->templateFile .= 'add_to_song.php';
		include_once $this->layout;

		if (isset($_POST['comment-text'])) {
			$pairs = array(
				'text' => $_POST['comment-text'],
				'song_id' => $song_id,
				'user_id' => $_SESSION['user_id']
			);
			if ($this->model->create($pairs)) {
				array_push($this->parameters, $song_id);
	            $this->addInfoMessage("Comment added.");
	            $this->redirect('songs', 'view', $this->parameters);
	        } else {
	            $this->addErrorMessage("Cannot add comment.");
	            $this->redirect('songs', 'view', $this->parameters);
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can delete it.");
            $this->redirect('comments');
		}

		//$this->model->setForeignKey();

		if ($this->model->delete($id)) {
			//$this->model->setForeignKey();
			$this->addInfoMessage("Comment deleted.");
            $this->redirect('comments');
		} else {
            $this->addErrorMessage("Cannot delete comment.");
            $this->redirect('comments');
        }
	}

	public function edit($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can edit it.");
            $this->redirect('comments');
		}

		$comment = $this->model->get($id);
		$playlists = $this->model->find(array('table' => 'playlists'));
		$songs = $this->model->find(array('table' => 'songs'));
		$users = $this->model->find(array('table' => 'users'));
		$model = $comment[0];
		
		$this->templateFile .= 'edit.php';
		include_once $this->layout;

		if (isset($_POST['comment-text'])) {
			$model['text'] = $_POST['comment-text'];
			$model['song_id'] = $_POST['song-id'];
			$model['playlist_id'] = $_POST['playlist-id'];
			$model['user_id'] = $_POST['user-id'];
			array_push($this->parameters, $id);

			$this->model->setForeignKey();

			if ($this->model->update($model)) {
				$this->model->setForeignKey();
				$this->addInfoMessage("Comment edited.");
            	$this->redirect('comments', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot edit comment to database.");
	            $this->redirect('comments', 'view', $this->parameters);
	        }
		}
	}
}