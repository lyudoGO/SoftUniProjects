<?php
namespace Models;

class SongModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'songs'));
	}

}