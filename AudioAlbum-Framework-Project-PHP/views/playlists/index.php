<div>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Likes</th>
			<th>Dislikes</th>
		</tr>
		<?php foreach ($playlists as $playlist) :?>
			<tr>
				<td><?= htmlspecialchars($playlist['id']); ?></td>
				<td><?= htmlspecialchars($playlist['name']); ?></td>
				<td><?= htmlspecialchars($playlist['likes']); ?></td>
				<td><?= htmlspecialchars($playlist['dislikes']); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>