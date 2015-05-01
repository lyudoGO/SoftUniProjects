<div>
	<h3>List songs</h3>
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
				<td><?= htmlspecialchars($song['id']); ?></td>
				<td><?= htmlspecialchars($song['name']); ?></td>
				<td><?= htmlspecialchars($song['artist']); ?></td>
				<td><?= htmlspecialchars($song['duration']); ?></td>
				<td><?= htmlspecialchars($song['likes']); ?></td>
				<td><?= htmlspecialchars($song['dislikes']); ?></td>
				<td><a href="/albums/songs/view/<?=$song['id'] ?>">[View]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<ul>
		<li><a href="/albums/songs/create">[Create new song]</a></li>
	</ul>
</div>