<?php
namespace Models;

class PlaylistModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'playlists'));
	}

	public function getWithSongs($id) {
		$statement = $this->db->prepare( "SELECT s.id as song_id, s.name as song_name, 
											(SELECT name FROM `genres` WHERE id = s.genre_id) as genre_name
										  FROM playlists p 
											JOIN playlists_songs ps on ps.playlist_id = p.id
											JOIN songs s on s.id = ps.song_id
										  WHERE p.id = ?");
		$statement->bind_param('i', $id);
		$statement->execute();
		
		$resultSet = $statement->get_result();

		$result = $this->processResults($resultSet);

		return $result;
	}

	public function addSong($playlistId, $songId) {
		$pairs = array(
			'playlist_id' => $playlistId,
			'song_id' => $songId
		);
		$this->table = 'playlists_songs';
		$result = $this->create($pairs);

		return $result;
	}
	
/*	public function getWithComments($id) {
		$statement = $this->db->prepare( "SELECT c.id as comment_id, c.text, c.user_id, u.username
											FROM comments c 
											JOIN users u ON u.id = c.user_id 
										  WHERE c.playlist_id = ?");
		$statement->bind_param('i', $id);
		$statement->execute();
		
		$resultSet = $statement->get_result();

		$result = $this->processResults($resultSet);

		return $result;
	}*/

/*	public function getSongs() {
		$statement = $this->db->prepare("SELECT * FROM songs");
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;		
	}*/
}