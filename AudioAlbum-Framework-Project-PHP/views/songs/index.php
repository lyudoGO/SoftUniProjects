<div>
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
				<td><?php echo $song['id']; ?></td>
				<td><?php echo $song['name']; ?></td>
				<td><?php echo $song['artist']; ?></td>
				<td><?php echo $song['duration']; ?></td>
				<td><?php echo $song['likes']; ?></td>
				<td><?php echo $song['dislikes']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>