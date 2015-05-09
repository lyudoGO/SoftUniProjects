<section id="home">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h2 class="panel-title"><strong>Playlist: </strong><?= htmlspecialchars($playlists[0]['name']); ?></h2>
		</div>
	    <div class="panel-body">
			<div class="row">
				<div class="col-md-2">
					<span><a class="btn-xs btn btn-primary" href="/albums/comments/playlist/<?=$playlists[0]['id'] ?>">Add Comment</a></span>
				</div>
				<div class="col-md-1">
					<form method="post" action="/albums/playlists/like">
						<input type="hidden" name="playlist-id" value="<?=$playlists[0]['id'] ?>">
						<input class="btn-xs btn btn-primary" type="submit" value="Like">
					</form>
				</div>
				<div class="col-md-1">
					<form method="post" action="/albums/playlists/dislike">
						<input type="hidden" name="playlist-id" value="<?=$playlists[0]['id'] ?>">
						<input class="btn-xs btn btn-primary" type="submit" value="Dislike">
					</form>
				</div>
				<div class="col-md-6">
					<form method="post" action="/albums/playlists/addsong">
					    <label for="addSong">Add song to playlist</label>
					    <select name="songs">
					    	<?php foreach ($songsToAdd as $song) :?>
								<option id="addSong" value="<?= htmlspecialchars($song['id']); ?>"><?= htmlspecialchars($song['name']); ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="playlist-id" value="<?=$playlists[0]['id'] ?>">
						<input class="btn-xs btn btn-primary" type="submit" value="Add song">	
					</form>					
				</div>
				<span class="badge glyphicon glyphicon-thumbs-up"><?= htmlspecialchars($playlists[0]['likes']); ?></span>
				<span class="badge glyphicon glyphicon-thumbs-down"><?= htmlspecialchars($playlists[0]['dislikes']); ?></span>
			</div>
		</div>
	</div>
	<h4>Comments</h4>
	<?php foreach ($playlists as $playlist) :?>
	<div class="panel panel-info">
		<div class="panel-heading text-left">
			<h3 class="panel-title"><strong>user: </strong><?= htmlspecialchars($playlist['username']); ?></h3>
		</div>
		<div class="panel-body text-left">
			<?= htmlspecialchars($playlist['text']); ?>
			<a class="btn-xs btn btn-info" href="/albums/comments/view/<?= $playlist['comment_id'] ?>">View</a>
		</div>
	</div>
	<?php endforeach; ?>
	<p><a class="btn-sm btn btn-primary" href="/albums/playlists">Cancel</a></p>
</section>
<div class="col-md-4">
	<?php if ($this->isAdmin()) :?>
	<aside id="admin-panel">
		<div class="panel panel-default">
			<div class="panel-heading">Admin panel for Playlist</div>
			<div class="panel-body">
				<a class="btn btn-primary btn-sm" href="/albums/playlists/edit/<?=$playlists[0]['id']; ?>">Edit</a>
				<a class="btn btn-primary btn-sm" href="/albums/playlists/delete/<?=$playlists[0]['id']; ?>">Delete</a>
			</div>
		</div>
	</aside>
	<?php endif; ?>
	<aside id="songs-list">
		<div class="panel-heading">Songs from <strong><?= htmlspecialchars($playlists[0]['name']); ?></strong></div>
		<?php foreach ($songs as $song) :?>
			<ul class="list-group">
				<li class="list-group-item"><span><?= htmlspecialchars($song['song_name']); ?></span>
					<span><a class="btn-xs btn btn-info" href="/albums/files/download/<?= $song['song_id'] ?>">Download</a></span>
					<span><a class="btn-xs btn btn-info" href="/albums/files/listen/<?= $song['song_id'] ?>">Listen</a></span>
				</li>
			</ul>
		<?php endforeach; ?>
	</aside>	
</div>