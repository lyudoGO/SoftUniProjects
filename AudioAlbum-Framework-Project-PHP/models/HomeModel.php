<?php
namespace Models;

class HomeModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'playlists'));
	}

}