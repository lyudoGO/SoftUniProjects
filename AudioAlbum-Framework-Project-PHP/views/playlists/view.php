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
				<td><?= $playlist['id']; ?></td>
				<td><?= htmlspecialchars($playlist['name']); ?></td>
				<td><?= htmlspecialchars($playlist['likes']); ?></td>
				<td><?= htmlspecialchars($playlist['dislikes']); ?></td>
				<td><a href="/albums/comments/playlist/<?=$playlist['id'] ?>">[Add Comment]</a></td>
				<td><a href="/albums/playlists/edit/<?=$playlist['id'] ?>">[Edit]</a></td>
				<td><a href="/albums/playlists/delete/<?=$playlist['id'] ?>">[Delete]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<ul>
		<li><a href="/albums/playlists">[Cancel]</a></li>
	</ul>
</div>