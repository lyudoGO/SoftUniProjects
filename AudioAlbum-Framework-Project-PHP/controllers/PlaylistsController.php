<?php
namespace Controllers;

class PlaylistsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Playlist', 'views\\playlists\\');

			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
			$this->activeClass = 'playlists';
	}

	public function index($paramOne = null, $paramTwo = null) {
		$this->authorize();

		if ($paramOne != null) {
			$this->page = intval($paramOne) <= PAGE_START ? PAGE_START : intval($paramOne);
		} 
		if ($paramTwo != null) {
			$this->pageSize = $paramTwo;
		}

		$from = ($this->page - 1) * $this->pageSize;

		$playlists = $this->model->find(array('limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function search($paramOne = null, $paramTwo = null) {
		$this->authorize();

		if ($this->isPost()) {
			$this->filter = $_POST['filter-playlist'];
		}

		if ($paramOne != null) {
			$this->page = intval($paramOne) <= PAGE_START ? PAGE_START : intval($paramOne);
		} 
		if ($paramTwo != null) {
			$this->pageSize = $paramTwo;
		}


		$from = ($this->page - 1) * $this->pageSize;

		$playlists = $this->model->find(array(
										'where' => 'name LIKE \'%' . $this->filter . '%\'', 
										'limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();

		$songs = $this->model->getWithSongs($id);
		$songsToAdd = $this->model->find(array('table' => 'songs', 'order by' => 'name'));
		$playlists = $this->model->find(array(
									'table' => 'playlists p',
									'columns' => 'p.id, p.name, p.likes, p.dislikes, c.id as comment_id, c.text, c.user_id, u.username',
									'left join' => 'comments c',
									'on' => 'c.playlist_id = p.id',
									'left join ' => 'users u',
									'on ' => 'u.id = c.user_id',
									'where' => 'p.id = ' . $id));

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
	            $this->redirect('playlists');
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can delete it.");
            $this->redirect('playlists');
		}

		if ($this->model->delete($id)) {
			$this->addInfoMessage("Playlist deleted.");
            $this->redirect('playlists');
		} else {
            $this->addErrorMessage("Cannot delete playlist.");
            $this->redirect('playlists');
        }
	}

	public function edit($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can edit it.");
            $this->redirect('playlists');
		}

		$playlist = $this->model->get($id);
		$model = $playlist[0];
		
		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if ($this->isPost()) {
			$model['name'] = $_POST['playlist-name'];
			$model['likes'] = $_POST['likes'];
			$model['dislikes'] = $_POST['dislikes'];
			if ($this->model->update($model)) {
				$this->addInfoMessage("Playlist edited.");
            	$this->redirect('playlists');
			} else {
	            $this->addErrorMessage("Cannot edit playlist.");
	            $this->redirect('playlists');
	        }
		}
	}

	public function addsong() {
		$this->authorize();
	
		if ($this->isPost()) {
			$playlistId = $_POST['playlist-id'];
			$songId = $_POST['songs'];

			if ($this->model->addSong($playlistId, $songId)) {
				$this->addInfoMessage("You are adding song.");
				array_push($this->parameters, $playlistId);
            	$this->redirect('playlists', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot add song.");
	            $this->redirect('playlists');
	        }
		}
	}

	public function like() {
		$this->authorize();
	
		if ($this->isPost()) {
			$id = $_POST['playlist-id'];
			$playlist = $this->model->get($id);
			$model = $playlist[0];
			$model['likes'] = $model['likes'] + 1;

			if ($this->model->update($model)) {
				array_push($this->parameters, $id);
				$this->addInfoMessage("You have a positive vote.");
            	$this->redirect('playlists', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot vote.");
	            $this->redirect('playlists', 'view', $this->parameters);
	        }
		}
	}

	public function dislike() {
		$this->authorize();
	
		if ($this->isPost()) {
			$id = $_POST['playlist-id'];
			$playlist = $this->model->get($id);
			$model = $playlist[0];
			$model['dislikes'] = $model['dislikes'] + 1;

			if ($this->model->update($model)) {
				array_push($this->parameters, $id);
				$this->addInfoMessage("You have a negative vote.");
            	$this->redirect('playlists', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot vote.");
	            $this->redirect('playlists', 'view', $this->parameters);
	        }
		}
	}
}