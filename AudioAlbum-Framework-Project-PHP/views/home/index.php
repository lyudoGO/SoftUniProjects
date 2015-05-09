<aside id="left">
	<h4>Top 5 playlists</h4>
	<ul class="list-group">
		<?php foreach ($playlists as $playlist) :?>
			<li class="list-group-item">
				<a href="/albums/playlists/view/<?=$playlist['id'] ?>"><?= htmlspecialchars($playlist['name']); ?></a>
				<span class="badge glyphicon glyphicon-thumbs-up"><?= htmlspecialchars($playlist['likes']); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>
</aside>
<section id="home">
	<div class="jumbotron">
	  <h1>Wellcom to Audio Albums Framework</h1>
	  <p>This is a simple project implementing a functionallity to upload, download and listen mp3 files.</p>
	  <p>
	  	<a class="btn btn-primary btn-md" href="/albums/account/login">Login</a>
		<a class="btn btn-primary btn-md" href="/albums/account/register">Register</a>
	  </p>
	</div>
</section>