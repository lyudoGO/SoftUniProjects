<?php
namespace Controllers;

class FilesController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'File', '/views/files/');
	}

	public function index(){
		$files = $this->model->find();
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$files = $this->model->get($id);
		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function upload($song_id) {
		$this->templateFile .= 'upload.php';
		include_once $this->layout;

		if (isset($_FILES['uploaded-file'])) {
			
			if($_FILES['uploaded-file']['error'] == 0) {
				$pairs = array(
					'name' => $_FILES['uploaded-file']['name'],
					'size' => intval($_FILES['uploaded-file']['size']),
					'mime' => $_FILES['uploaded-file']['type'],
					'data' => file_get_contents($_FILES['uploaded-file']['tmp_name']),
					'song_id' => $song_id
				);
			/*	$uploaddir = 'C:/xampp/htdocs/albums/views/files/';
			   $file = basename($_FILES['uploaded-file']['name']);
			   $uploadfile = $uploaddir . $file;*/
			
			   
			
	/*		   if (move_uploaded_file($_FILES['uploaded-file']['tmp_name'], $uploadfile)) {
			   		echo "File uploaded";
			   } else {
			   		echo "Cannot upload";
			   }*/
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
		if ($this->model->delete($id)) {
			$this->addInfoMessage("File deleted.");
            $this->redirect('files');
		} else {
            $this->addErrorMessage("Cannot delete file.");
        }
	}
}