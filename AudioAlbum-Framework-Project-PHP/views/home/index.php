<aside id="right">
	<h4>Top 5 playlists</h4>
	<ul>
		<?php foreach ($playlists as $playlist) :?>
			<li>
				<a href="/albums/playlists/view/<?=$playlist['id'] ?>"><?= htmlspecialchars($playlist['name']); ?></a>
				<span></span>
			</li>
		<?php endforeach; ?>
	</ul>
</aside>
<section id="home">
	<h2>Home page</h2>
	<ul>
		<li><a href="/albums/login">[Login]</a></li>
		<li><a href="/albums/register">[Register]</a></li>
	</ul>
</section>