<?php
namespace Models;

class CommentModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'comments'));
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