<?php
namespace Models;

class GenreModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'genres'));
	}

}