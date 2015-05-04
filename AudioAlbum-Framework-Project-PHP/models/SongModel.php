<?php
namespace Models;

class SongModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'songs'));
	}

	public function setForeignKey() {
		$key = $this->db->query('SELECT @@FOREIGN_KEY_CHECKS');
		if ($key == 1) {
			$this->db->query('SET FOREIGN_KEY_CHECKS = 0');
		} else {
			$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		}
	}

	public function getWithComments($id) {
		$statement = $this->db->prepare( "SELECT c.id as comment_id, c.text, c.user_id, u.username
											FROM comments c 
											JOIN users u ON u.id = c.user_id 
										  WHERE c.song_id = ?");
		$statement->bind_param('i', $id);
		
		$statement->execute();
		
		$resultSet = $statement->get_result();

		$result = $this->processResults($resultSet);

		return $result;
	}
}
