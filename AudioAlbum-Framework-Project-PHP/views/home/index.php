<div>
	<h2>Home page</h2>
	<h4>Playlist list</h4>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
		<?php foreach ($playlists as $playlist) :?>
			<tr>
				<td><?= $playlist['id']; ?></td>
				<td><?= htmlspecialchars($playlist['name']); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>