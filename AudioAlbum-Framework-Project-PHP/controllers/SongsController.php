<?php
namespace Controllers;

class SongsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Song', '/views/songs/');
	}

	public function index(){
		$songs = $this->model->find();
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$songs = $this->model->get($id);
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function upload() {
		$this->templateFile .= 'upload.php';
		include_once $this->layout;

		if (isset($_FILES['uploaded-file'])) {
			//var_dump($_FILES['uploaded-file']);die;
			if($_FILES['uploaded-file']['error'] == 0) {
				$pairs = array(
					'name' => $_FILES['uploaded-file']['name'],
					'size' => intval($_FILES['uploaded-file']['size']),
					'mime' => $_FILES['uploaded-file']['type'],
					'data' => file_get_contents($_FILES['uploaded-file']['tmp_name']),
				);
			if ($this->model->create($pairs)) {
	            $this->addInfoMessage("File uploaded.");
	            //$this->redirect('songs');
	        } else {
	            $this->addErrorMessage("Cannot upload file.");
	        }
		} else {
			$this->addErrorMessage("An error accured while the file was being uploaded.");
		}

		}
	}
}