<div>
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
	<ul>
		<li><a href="/albums/playlists/create">[Create new playlist]</a></li>
	</ul>
</div>