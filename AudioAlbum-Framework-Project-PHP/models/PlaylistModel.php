<?php
namespace Models;

class PlaylistModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'playlists'));
	}

}