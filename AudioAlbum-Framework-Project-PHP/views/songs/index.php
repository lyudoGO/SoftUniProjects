<section id="home">
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
				<td><a href="/albums/files/download/<?=$song['id'] ?>">[Download]</a></td>
				<td><a href="/albums/files/listen/<?=$song['id'] ?>">[Listen]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php if(false) :?>
		<div>
			<h3>Listen song</h3>
			<audio controls autoplay>
			  	<source src="<?php echo $_SESSION['song']['data']; ?>" type="audio/mpeg">
				<p>Your browser does not support the audio element.</p>
			</audio>
			<a href="/albums/songs">[Cancel]</a>
		</div>
	<?php endif ?>
	<p><a href="/albums/songs/create">[Create new song]</a></p>
	<ul id="pagging">
		<li><a href="/albums/songs/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">[Previous]</a></li>
		<li><a href="/albums/songs/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">[Next]</a></li>
	</ul>
</section>