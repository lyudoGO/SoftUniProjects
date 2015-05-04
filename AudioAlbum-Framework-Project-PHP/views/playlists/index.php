<section id="home">
	<h3>List Playlists</h3>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Likes</th>
			<th>Dislikes</th>
		</tr>
		<?php foreach ($playlists as $playlist) :?>
			<tr>
				<td><?= $playlist['id']; ?></td>
				<td><?= htmlspecialchars($playlist['name']); ?></td>
				<td><?= htmlspecialchars($playlist['likes']); ?></td>
				<td><?= htmlspecialchars($playlist['dislikes']); ?></td>
				<td><a href="/albums/playlists/view/<?=$playlist['id'] ?>">[View]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<p><a href="/albums/playlists/create">[Create new playlist]</a></p>
	<ul id="pagging">
		<li><a href="/albums/playlists/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">[Previous]</a></li>
		<li><a href="/albums/playlists/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">[Next]</a></li>
	</ul>
</section>
<aside id="right">
	<h4>Top 5 playlists</h4>
	<ul>
		<?php foreach ($playlists as $playlist) :?>
			<li>
				<a href="/albums/playlists/view/<?= $playlist['id'] ?>"><?= htmlspecialchars($playlist['name']); ?></a>
				<span></span>
			</li>
		<?php endforeach; ?>
	</ul>
</aside>