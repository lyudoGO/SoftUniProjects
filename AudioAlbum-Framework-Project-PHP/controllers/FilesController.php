<?php
namespace Controllers;

class FilesController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'File', '/views/files/');
	}

	public function index(){
		$this->authorize();
		$files = $this->model->find();
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();
		$files = $this->model->get($id);
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function download($songId) {
		$this->authorize();
		$file = $this->model->findBySongId($songId);

        if($file) {
            header("Content-Type: ". $file['mime']);
            header("Content-Length: ". $file['size']);
            header("Content-Disposition: attachment; filename=". $file['name']);

        } else {
        	$this->addErrorMessage("Error!No file exists for this song.");
        	$this->redirect('songs');
        }
	}

	public function listen($songId) {
		$this->authorize();
		$file = $this->model->findBySongId($songId);

		if ($file) {
			$uploadDir = DEFAULT_ROOT_DIR . '\\files\\';
			$uploadFile = $uploadDir . basename($file['name']);
			file_put_contents($uploadFile, $file['data']);
			
			$this->templateFile .= 'listen.php';
			include_once $this->layout;

		} else {
			$this->addErrorMessage("Error!No file for this song.");
			$this->redirect('songs');
		}
	}

	public function upload($songId) {
		$this->authorize();
		$this->templateFile .= 'upload.php';
		include_once $this->layout;

		if (isset($_FILES['uploaded-file'])) {
			
			if($_FILES['uploaded-file']['error'] == 0) {
				$pairs = array(
					'name' => $_FILES['uploaded-file']['name'],
					'size' => intval($_FILES['uploaded-file']['size']),
					'mime' => $_FILES['uploaded-file']['type'],
					'data' => file_get_contents($_FILES['uploaded-file']['tmp_name']),
					'song_id' => $songId
				);

				if ($this->model->create($pairs)) {
		            $this->addInfoMessage("File uploaded.");
		            $this->redirect('files');
		        } else {
		            $this->addErrorMessage("Cannot upload file to database.");
		        }
			} else {
				$this->addErrorMessage("Error uploading from tmp.");
			}
		}
	}

	public function delete($id) {
		$this->authorize();
		if ($this->model->delete($id)) {
			$this->addInfoMessage("File deleted.");
            $this->redirect('files');
		} else {
            $this->addErrorMessage("Cannot delete file.");
        }
	}
}