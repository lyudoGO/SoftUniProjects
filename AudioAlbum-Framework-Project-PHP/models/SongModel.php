<?php
namespace Models;

class SongModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'songs'));
	}

	public function addToPlaylist($songId, $playlistId) {
		$pairs = array(
			'playlist_id' => $playlistId,
			'song_id' => $songId
		);
		$this->table = 'playlists_songs';
		$result = $this->create($pairs);

		return $result;
	}
	
/*	public function setForeignKey() {
		$key = $this->db->query('SELECT @@FOREIGN_KEY_CHECKS');
		if ($key == 1) {
			$this->db->query('SET FOREIGN_KEY_CHECKS = 0');
		} else {
			$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		}
	}*/

/*	public function getWithComments($id) {
		$statement = $this->db->prepare("SELECT c.id as comment_id, c.text, c.user_id, u.username
											FROM comments c 
											JOIN users u ON u.id = c.user_id 
										  WHERE c.song_id = ?");
		$statement->bind_param('i', $id);
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;
	}*/

/*	public function getAllWithGenres() {
		$statement = $this->db->prepare("SELECT s.id, s.name, s.artist, s.duration, s.likes, s.dislikes, s.genre_id,
												g.name as genre_name
											FROM songs s 
											LEFT JOIN genres g ON g.id = s.genre_id");
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet); 

		return $result;
	}*/

/*	public function getGenres($genreId = null) {
		if (empty($genreId)) {
			$statement = $this->db->prepare("SELECT * FROM genres ORDER BY id");
		} else {
			$statement = $this->db->prepare("SELECT * FROM genres WHERE id = ?");
			$statement->bind_param('s', $genreId);
		}
	
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;
	}*/

/*	public function getPlaylists() {
		$statement = $this->db->prepare("SELECT * FROM playlists");
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;		
	}*/
}
