<?php
namespace Controllers;

class SongsController extends BaseController {

	protected $genreName;

	public function __construct(){
		parent::__construct(get_class(), 'Song', '/views/songs/');

			$this->page = PAGE_START;
			$this->pageSize = PAGE_SIZE;
			$this->genreName = '';
			$this->activeClass = 'songs';
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

		$songs = $this->model->find(array(
								'table' => 'songs s',
								'columns' => 's.id, s.name, s.artist, s.duration, s.likes, s.dislikes, s.genre_id,
												g.name as genre_name',
								'left join' => 'genres g',
								'on' => 'g.id = s.genre_id',
								'limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function search($paramOne = null, $paramTwo = null) {
		$this->authorize();

		if ($paramOne != null) {
			$this->page = intval($paramOne) <= PAGE_START ? PAGE_START : intval($paramOne);
		} 
		if ($paramTwo != null) {
			$this->pageSize = $paramTwo;
		}


		$from = ($this->page - 1) * $this->pageSize;

		if ($this->isPost()) {
			$this->filter = $_POST['song-name'];
			$this->genreName = $_POST['genre-name'];
		}

		$songs = $this->model->find(array(
					'table' => 'songs s',
					'columns' => 's.id, s.name, s.artist, s.duration, s.likes, s.dislikes, s.genre_id,
									g.name as genre_name',
					'left join' => 'genres g',
					'on' => 'g.id = s.genre_id',
					'where' => 's.name LIKE \'%' . $this->filter . '%\'',
					'and' =>  'g.name LIKE \'%' . $this->genreName . '%\'',
					'limit' => $from . ', ' . $this->pageSize));
		
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();

		$result = $this->model->get($id); 
		$song = $result[0];

		$playlists = $this->model->find(array(
									'table' => 'playlists',
									'columns' => 'id, name',
									'order by' => 'id'));

		if (empty($song['genre_id'])) {
			$genre = array('name' => '');
		} else {
			$genreStatment = $this->model->find(array(
									'table' => 'genres',
									'where' => 'id = ' . $song['genre_id']));
			$genre = array('name' => $genreStatment[0]['name']);
		}

		$comments = $this->model->find(array(
									'table' => 'comments c',
									'columns' => 'c.id as comment_id, c.text, c.user_id, u.username',
									'left join' => 'users u',
									'on' => 'u.id = c.user_id',
									'where' => 'c.song_id = ' . $id,
									'order by' => 'c.id'));//getWithComments($id);

		$this->templateFile .= 'view.php';
		include_once $this->layout;
	}

	public function create() {
		$this->authorize();

		$genres = $this->model->find(array('table' => 'genres', 'order by' => 'name'));//getGenres();

		$this->templateFile .= 'create.php';
		include_once $this->layout;

		if ($this->isPost()) {
			$pairs = array(
				'name' => $_POST['song-name'],
				'artist' => $_POST['artist-name'],
				'duration' => $_POST['duration'],
				'genre_id' => $_POST['genres']
			);
			if ($this->model->create($pairs)) {
				$result = $this->model->find(array('where' => 'name = ' . $pairs['name']));
				$songId = $result[0]['id'];
				array_push($this->parametars, $songId);
	            $this->addInfoMessage("Song created.");
	            $this->redirect('songs', 'view', $this->parametars);
	        } else {
	            $this->addErrorMessage("Cannot create song.");
	            $this->redirect('songs');
	        }
		}
	}

	public function delete($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can delete it.");
            $this->redirect('songs');
		}

		//$this->model->setForeignKey();

		if ($this->model->delete($id)) {
			//$this->model->setForeignKey();
			$this->addInfoMessage("Song deleted.");
            $this->redirect('songs');
		} else {
            $this->addErrorMessage("Cannot delete song.");
            $this->redirect('songs');
        }
	}

	public function edit($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can edit it.");
            $this->redirect('songs');
		}

		$song = $this->model->get($id);
		$genres = $this->model->find(array('table' => 'genres', 'order by' => 'name'));//getGenres();
		$model = $song[0];

		$this->templateFile .= 'edit.php';
		include_once $this->layout;
	
		if ($this->isPost()) {
			$model['name'] = $_POST['song-name'];
			$model['artist'] = $_POST['artist'];
			$model['duration'] = $_POST['duration'];
			$model['genre_id'] = $_POST['genres'];

			if ($this->model->update($model)) {
				$this->addInfoMessage("Song edited.");
            	$this->redirect('songs');
			} else {
	            $this->addErrorMessage("Cannot edit song.");
	            $this->redirect('songs');
	        }
		}
	}

	public function like() {
		$this->authorize();
	
		if ($this->isPost()) {
			$id = $_POST['song-id'];
			$playlist = $this->model->get($id);
			$model = $playlist[0];
			$model['likes'] = $model['likes'] + 1;
			if ($this->model->update($model)) {
				array_push($this->parameters, $id);
				$this->addInfoMessage("You have a positive vote.");
            	$this->redirect('songs', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot vote.");
	            $this->redirect('songs', 'view', $this->parameters);
	        }
		}
	}

	public function dislike() {
		$this->authorize();
	
		if ($this->isPost()) {
			$id = $_POST['song-id'];
			$playlist = $this->model->get($id);
			$model = $playlist[0];
			$model['dislikes'] = $model['dislikes'] + 1;
			if ($this->model->update($model)) {
				array_push($this->parameters, $id);
				$this->addInfoMessage("You have a negative vote.");
            	$this->redirect('songs', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot vote.");
	            $this->redirect('songs', 'view', $this->parameters);
	        }
		}
	}

	public function addplaylist() {
		$this->authorize();
	
		if ($this->isPost()) {
			$songId = $_POST['song-id'];
			$playlistId = $_POST['playlist'];

			if ($this->model->addToPlaylist($songId, $playlistId)) {
				$this->addInfoMessage("You are adding to playlist.");
				array_push($this->parameters, $songId);;
            	$this->redirect('songs', 'view', $this->parameters);
			} else {
	            $this->addErrorMessage("Cannot add to playlist.");
	            $this->redirect('songs', 'view', $this->parameters);
	        }
		}
	}

/*	protected function genresToArray($results) {
		$genres = array();
		if ($results) {
			for ($i=0; $i < count($results); $i++) { 
				$genreId = $results[$i]['id'];
				$genreName = $results[$i]['name'];
				$genres[$genreId] = $genreName;
			}
		}

		return $genres;
	}*/
}