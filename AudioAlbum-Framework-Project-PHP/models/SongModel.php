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
}