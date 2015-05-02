<div>
	<h3>List Comments</h3>
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
				<td><?php echo $comment['id']; ?></td>
				<td><?php echo $comment['text']; ?></td>
				<td><?php echo $comment['song_id']; ?></td>
				<td><?php echo $comment['playlist_id']; ?></td>
				<td><?php echo $comment['user_id']; ?></td>
				<td><a href="/albums/comments/view/<?=$comment['id'] ?>">[View]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>