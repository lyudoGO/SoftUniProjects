<section id="home">
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
	<h4>Comments</h4>
	<table>
		<tr>
			<th>Id</th>
			<th>Comment text</th>
			<th>Username</th>
		</tr>
		<?php foreach ($comments as $comment) :?>
			<tr>
				<td><?= $comment['comment_id']; ?></td>
				<td><?= htmlspecialchars($comment['text']); ?></td>
				<td><?= htmlspecialchars($comment['username']); ?></td>
				<td><a href="/albums/comments/view/<?= $comment['comment_id'] ?>">[View]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<ul>
		<li><a href="/albums/playlists">[Cancel]</a></li>
	</ul>
</section>
<aside id="right">
	<h4>Song from playlist</h4>
	<ul>
		<?php foreach ($songs as $song) :?>
			<li>
				<a href="/albums/songs/view/<?= $song['song_id'] ?>"><?= htmlspecialchars($song['song_name']); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</aside>