<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/albums/content/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/albums/content/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/albums/content/styles.css">
	<title>Audio Albums</title>
</head>
<body>
	<script src="/albums/content/jquery/jquery-2.1.4.min.js"></script>
	<script src="/albums/content/bootstrap/js/bootstrap.min.js"></script>
	<header>
		<h1>Audio Albums</h1>
		<div class="col-md-10">
			<ul class="nav nav-pills">
				<li class="<?php if($this->activeClass == 'home') echo 'active'; ?>"><a href="/albums">Home</a></li>
				<li class="<?php if($this->activeClass == 'playlists') echo 'active'; ?>"><a href="/albums/playlists">Playlists</a></li>
				<li class="<?php if($this->activeClass == 'songs') echo 'active'; ?>"><a href="/albums/songs">Songs</a></li>
				<li class="<?php if($this->activeClass == 'genres') echo 'active'; ?>"><a href="/albums/genres">Genres</a></li>
				<li class="<?php if($this->activeClass == 'commnets') echo 'active'; ?>"><a href="/albums/comments">Comments</a></li>
				<li class="<?php if($this->activeClass == 'account') echo 'active'; ?>"><?php if($this->isLoggedIn()) :?><a href="/albums/account/edit">Account</a><?php endif; ?></li>
				<li class="<?php if($this->activeClass == 'files') echo 'active'; ?>"><?php if($this->isAdmin()) :?><a href="/albums/files">Files</a><?php endif; ?></li>
			</ul>
		</div>
		<?php if($this->isLoggedIn()) :?>
		<div id="loggedin-info" class="col-md-2">
			<form class="form-horizontal" action="/albums/account/logout/">
				<fieldset>
					<div class="form-group form-group-sm">
						<legend>Hello, <?= htmlspecialchars($_SESSION['username']); ?></legend>
						<input class="btn-xs btn btn-primary" type="submit" value="Logout">
					</div>
				</fieldset>
			</form>
		</div>
		<?php endif ?>
	</header>
	<div id="messages"><?php include_once('\\views\\layouts\\messages.php'); ?></div>
	<div id="container" class="container-fluid">
	