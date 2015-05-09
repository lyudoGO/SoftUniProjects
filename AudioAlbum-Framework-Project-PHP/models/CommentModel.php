<?php
namespace Models;

class CommentModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'comments'));
	}

	public function getJoinedAll($id) {
		$statement = $this->db->prepare("SELECT c.id, c.text, c.song_id, c.playlist_id, c.user_id, 
												s.name as song_name, p.name as playlist_name, u.username
											FROM comments c 
											LEFT JOIN songs s ON s.id = c.song_id 
											LEFT JOIN playlists p ON p.id = c.playlist_id 
											LEFT JOIN users u ON u.id = c.user_id 
											WHERE c.id = ?");

		$statement->bind_param('i', $id);
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;
	}
	
	public function setForeignKey() {
		$key = $this->db->query('SELECT @@FOREIGN_KEY_CHECKS');
		if ($key == 1) {
			$this->db->query('SET FOREIGN_KEY_CHECKS = 0');
		} else {
			$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		}
	}


/*
	public function getPlaylists() {
		$statement = $this->db->prepare("SELECT id, name FROM playlists");
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;		
	}

	public function getSongs() {
		$statement = $this->db->prepare("SELECT id, name FROM songs");
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;		
	}

	public function getUsers() {
		$statement = $this->db->prepare("SELECT id, username FROM users");
		$statement->execute();
		
		$resultSet = $statement->get_result();
		$result = $this->processResults($resultSet);

		return $result;		
	}*/
}