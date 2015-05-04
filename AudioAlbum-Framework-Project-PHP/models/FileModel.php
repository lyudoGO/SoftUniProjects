<?php
namespace Models;

class FileModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'files'));
	}

	public function findBySongId($song_id) {

		$query = "SELECT * FROM files WHERE song_id = " . $song_id;

		$resultSet = $this->db->query($query);

		$file = mysqli_fetch_assoc($resultSet);

		return $file;
	}
}