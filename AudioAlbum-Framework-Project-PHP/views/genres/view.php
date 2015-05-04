<section>
	<table>
		<tr>
			<th>Id</th>
			<th>Genre Name</th>
		</tr>
		<tr>
			<td><?= htmlspecialchars($genre[0]['id']); ?></td>
			<td><?= htmlspecialchars($genre[0]['name']); ?></td>
		</tr>
	</table>
	<table>
		<tr>
			<th>Id</th>
			<th>Song Name</th>
		</tr>
		<?php foreach ($songs as $song) :?>
			<tr>
				<td><?= htmlspecialchars($song['song_id']); ?></td>
				<td><?= htmlspecialchars($song['song_name']); ?></td>
				<td><a href="/albums/songs/edit/<?=$song['song_id'] ?>">[Edit]</a></td>
				<td><a href="/albums/songs/delete/<?=$song['song_id'] ?>">[Delete]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<p><a href="/albums/genres">[Cancel]</a></p>
</section>