<?php
namespace Controllers;

class PlaylistsController extends BaseController {

	public function __construct(){
		parent::__construct(get_class(), 'Playlist', 'views\\playlists\\');
	}

	public function index(){
		$playlists = $this->modelName->find();
		$templateFile = DEFAULT_ROOT_DIR . $this->viewsDir . 'index.php';
		include_once $this->layout;
	}

	public function view($id) {
		$playlists = $this->modelName->get($id);
		$templateFile = DEFAULT_ROOT_DIR . $this->viewsDir . 'index.php';
		include_once $this->layout;
	}

	public function create(){
		$templateFile = DEFAULT_ROOT_DIR . $this->viewsDir . 'create.php';
		include_once $this->layout;

		if (isset($_POST['playlist-name'])) {
			$pairs = array('name' => $_POST['playlist-name']);
			if ($this->modelName->create($pairs)) {
	            echo "Playlist created.";
	            header("Location:");
	        } else {
	            echo "Cannot create author.";
	        }
		}
	}
}