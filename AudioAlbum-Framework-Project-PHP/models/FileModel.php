<?php
namespace Models;

class FileModel extends BaseModel {

	public function __construct($args = array()) {
		parent::__construct(array('table' => 'files'));
	}

}