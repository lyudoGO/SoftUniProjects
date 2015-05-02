<div>
	<h3>View Comment</h3>
	<table>
		<tr>
			<th>Id</th>
			<th>Text</th>
			<th>Song Id</th>
			<th>Playlist Id</th>
			<th>User Id</th>
		</tr>
		<?php foreach ($comments as $comment) :?>
			<tr>
				<td><?= htmlspecialchars($comment['id']); ?></td>
				<td><?= htmlspecialchars($comment['text']); ?></td>
				<td><?= htmlspecialchars($comment['song_id']); ?></td>
				<td><?= htmlspecialchars($comment['playlist_id']); ?></td>
				<td><?= htmlspecialchars($comment['user_id']); ?></td>
				<td><a href="/albums/comments/edit/<?=$comment['id'] ?>">[Edit]</a></td>
				<td><a href="/albums/comments/delete/<?=$comment['id'] ?>">[Delete]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<ul>
		<li><a href="/albums/comments">[Cancel]</a></li>
	</ul>
</div>