<?php
namespace Controllers;

class FilesController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'File', 'views/files/');

		$this->activeClass = 'files';
	}

	public function index(){
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can view it.");
            $this->redirect('home');
		}

		$files = $this->model->find();

		$this->templateFile .= 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can view it.");
            $this->redirect('home');
		}

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
			header("Content-Type: ". $file['mime']);
            header("Content-Length: ". $file['size']);
            echo $file['data'];
 			//$uploadDir = DEFAULT_ROOT_DIR . 'upload/';
			//$uploadFile = $uploadDir . basename($file['name']);
			//file_put_contents($uploadFile, $file['data']);var_dump($uploadFile);

            //$uploadFile = $file['song_url'];

			$this->templateFile .= 'listen.php';
			include_once $this->layout;

		} else {
			$this->addErrorMessage("Error!No file to listen for this song.");
			$this->redirect('songs');
		}
	}

	public function upload($songId) {
		$this->authorize();

		$this->templateFile .= 'upload.php';
		include_once $this->layout;
		array_push($this->parameters, $songId);

		if (isset($_FILES['uploaded-file'])) {
			
			if($_FILES['uploaded-file']['error'] == 0) {
				$size = intval($_FILES['uploaded-file']['size']);
				if ($size > FILE_SIZE) {
		            $this->addInfoMessage("File size should be maximum" . FILE_SIZE ." bytes");
		            $this->redirect('songs', 'view', $this->parameters);
				}
				$mime = $_FILES['uploaded-file']['type'];
				if ($mime != FILE_TYPE) {
		            $this->addInfoMessage("File type should be " . FILE_TYPE);
		            $this->redirect('songs', 'view', $this->parameters);
				}

				$uploadDir = DEFAULT_ROOT_DIR . 'upload/';
				$uploadFile = $uploadDir . basename($_FILES['uploaded-file']['name']);

				$pairs = array(
					'name' => $_FILES['uploaded-file']['name'],
					'size' => $size,
					'mime' => $_FILES['uploaded-file']['type'],
					'data' => file_get_contents($_FILES['uploaded-file']['tmp_name']),
					'song_id' => $songId,
					'song_url' => $uploadFile
				);

				if (move_uploaded_file($_FILES['uploaded-file']['tmp_name'], $uploadFile)) {
				    $this->addInfoMessage("File is valid, and was successfully uploaded.");
					//$this->redirect('songs', 'view', $this->parameters);
				} else {
				    $this->addErrorMessage("Error upload file to server.");
					//$this->redirect('songs', 'view', $this->parameters);
				}	

				if ($this->model->create($pairs)) {
		            $this->addInfoMessage("File uploaded.");
		            $this->redirect('songs');
		        } else {
		            $this->addErrorMessage("Cannot upload file to database.");
		            $this->redirect('songs', 'view', $this->parameters);
		        }
			} else {
				$this->addErrorMessage("Error uploading from temp.");
				$this->redirect('songs', 'view', $this->parameters);
			}
		}
	}

	public function delete($id) {
		$this->authorize();
		if (!$this->isAdmin()) {
			$this->addInfoMessage("Only admin can delete it.");
            $this->redirect('home');
		}
		
		if ($this->model->delete($id)) {
			$this->addInfoMessage("File deleted.");
            $this->redirect('files');
		} else {
            $this->addErrorMessage("Cannot delete file.");
            $this->redirect('files');
        }
	}
}

/*			header("Content-Type: ". $file['mime']);
            header("Content-Length: ". $file['size']);*/
            //header("Content-Disposition: attachment; filename=". $file['name']);
            //header("Location: " . DEFAULT_ROOT_DIR . '/files/listen/' . $file['id']);
			//echo $file['data'];
			//$uploadDir = DEFAULT_ROOT_DIR . 'download/';
			//$uploadFile = $uploadDir . basename($_FILES['uploaded-file']['name']);
			//file_put_contents($uploadFile, $file['data']);
			//$urlListen = DEFAULT_ROOT_DIR . 'upload/' . basename($file['name']);//$file['song_url'];