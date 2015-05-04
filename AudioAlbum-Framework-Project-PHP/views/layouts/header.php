<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/albums/content/styles.css">
	<title>Audio Albums</title>
</head>
<body>
	<header>
		<h1>Audio Albums</h1>
		<nav>
			<a href="/albums">Home</a>
			<a href="/albums/playlists">Playlists</a>
			<a href="/albums/songs">Songs</a>
			<a href="/albums/genres">Genres</a>
			<a href="/albums/comments">Comments</a>
			<a href="/albums/files">Files</a>
		</nav>
		<?php if($this->isLoggedIn()) :?>
		<div id="loggedin-info">
			<span>Hello, <?= htmlspecialchars($_SESSION['username']); ?></span>
			<form action="/albums/account/logout/"><input type="submit" value="Logout"></form>
		</div>
	<?php endif ?>
	</header>
	<div id="messages"><?php include_once('\\views\\layouts\\messages.php'); ?></div>
	<div id="container">
	