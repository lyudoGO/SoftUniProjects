<div>
	<h3>Song view</h3>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Artist</th>
			<th>Duration</th>
			<th>Likes</th>
			<th>Dislikes</th>
		</tr>
		<?php foreach ($songs as $song) :?>
			<tr>
				<td><?= $song['id']; ?></td>
				<td><?= htmlspecialchars($song['name']); ?></td>
				<td><?= htmlspecialchars($song['artist']); ?></td>
				<td><?= htmlspecialchars($song['duration']); ?></td>
				<td><?= htmlspecialchars($song['likes']); ?></td>
				<td><?= htmlspecialchars($song['dislikes']); ?></td>
				<td><a href="/albums/comments/song/<?=$song['id'] ?>">[Add Comment]</a></td>
				<td><a href="/albums/files/upload/<?=$song['id'] ?>">[Upload file]</a></td>
				<td><a href="/albums/files/download/<?=$song['id'] ?>">[Download file]</a></td>
				<td><a href="/albums/songs/edit/<?=$song['id'] ?>">[Edit]</a></td>
				<td><a href="/albums/songs/delete/<?=$song['id'] ?>">[Delete]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<ul>
		<li><a href="/albums/songs">[Cancel]</a></li>
	</ul>
</div>