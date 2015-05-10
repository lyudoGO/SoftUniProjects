<section id="home">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h2 class="panel-title">
	    		<strong>Song: </strong><?= htmlspecialchars($song['name']); ?>
	    		<strong>Artist: </strong><?= htmlspecialchars($song['artist']); ?>
	    		<strong>Duration: </strong><?= htmlspecialchars($song['duration']); ?>
	    		<strong>Genre: </strong><?= htmlspecialchars($genre['name']); ?>
	    	</h2>
		</div>
	    <div class="panel-body">
			<div class="row">
				<div class="col-md-2">
					<span><a class="btn-xs btn btn-primary" href="/albums/comments/song/<?= $song['id']; ?>">Add Comment</a></span>
				</div>
				<div class="col-md-1">
					<form method="post" action="/albums/songs/like">
						<input type="hidden" name="song-id" value="<?= $song['id']; ?>">
						<input class="btn-xs btn btn-primary" type="submit" value="Like">
					</form>
				</div>
				<div class="col-md-1">
					<form method="post" action="/albums/songs/dislike">
						<input type="hidden" name="song-id" value="<?=$song['id']; ?>">
						<input class="btn-xs btn btn-primary" type="submit" value="Dislike">
					</form>
				</div>
				<div class="col-md-6">
					<form method="post" action="/albums/songs/addplaylist">
					    <label for="addSong">Add to playlist</label>
					    <select name="playlist-id">
					    	<?php foreach ($playlists as $playlist) :?>
								<option id="addSong" value="<?= htmlspecialchars($playlist['id']); ?>"><?= htmlspecialchars($playlist['name']); ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="song-id" value="<?= $song['id']; ?>">
						<input class="btn-xs btn btn-primary" type="submit" value="Add to playlist">	
					</form>					
				</div>
				<span class="badge glyphicon glyphicon-thumbs-up"><?= htmlspecialchars($song['likes']); ?></span>
				<span class="badge glyphicon glyphicon-thumbs-down"><?= htmlspecialchars($song['dislikes']); ?></span>
			</div>
		</div>
		<p>
			<a class="btn-sm btn btn-primary" href="/albums/files/upload/<?= $song['id'] ?>">Upload file</a>
			<a class="btn-sm btn btn-primary" href="/albums/files/download/<?= $song['id'] ?>">Download file</a>
		</p>
	</div>
	<?php if ($comments) :?>
		<h4>Comments</h4>
		<?php foreach ($comments as $comment) :?>
		<div class="panel panel-info">
			<div class="panel-heading text-left">
				<h3 class="panel-title"><strong>user: </strong><?= htmlspecialchars($comment['username']); ?></h3>
			</div>
			<div class="panel-body text-left">
				<?= htmlspecialchars($comment['text']); ?>
				<a class="btn-xs btn btn-info" href="/albums/comments/view/<?= $comment['comment_id']; ?>">View</a>
			</div>
		</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<p><a class="btn-sm btn btn-primary" href="/albums/songs">Cancel</a></p>
</section>
<div class="col-md-4">
	<?php if ($this->isAdmin()) :?>
	<aside id="admin-panel">
		<div class="panel panel-default">
			<div class="panel-heading">Admin panel for Songs</div>
			<div class="panel-body">
				<a class="btn btn-primary btn-sm" href="/albums/songs/edit/<?= $song['id'] ?>">Edit</a>
				<a class="btn btn-primary btn-sm" href="/albums/songs/delete/<?= $song['id'] ?>">Delete</a>
			</div>
		</div>
	</aside>
	<?php endif; ?>
</div>