<?php
namespace Models;

class CommentModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'comments'));
	}

}