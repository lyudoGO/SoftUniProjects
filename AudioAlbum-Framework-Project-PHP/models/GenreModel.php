<?php
namespace Models;

class GenreModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'genres'));
	}

/*	public function getWithSongs($id) {
		$statement = $this->db->prepare( "SELECT g.id, g.name, s.id as song_id, s.name as song_name
											FROM genres g 
											JOIN songs s ON s.genre_id = g.id 
										  WHERE g.id = ?");
		$statement->bind_param('i', $id);
		
		$statement->execute();
		
		$resultSet = $statement->get_result();

		$result = $this->processResults($resultSet);

		return $result;
	}*/
}