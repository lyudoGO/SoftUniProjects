<section id="home">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h2 class="panel-title text-left"><strong>Username:  </strong><?= htmlspecialchars($comment['username']); ?>
	    	<strong>Playlist:  </strong><?= htmlspecialchars($comment['playlist_name']); ?>
	    	<strong>Song:  </strong><?= htmlspecialchars($comment['song_name']); ?>
	    	</h2>
		</div>
	    <div class="panel-body">
			<div class="row">
				<div class="col-md-12 text-left">
					<?= htmlspecialchars($comment['text']); ?>
				</div>
			</div>
		</div>
	</div>
	<p><a class="btn-sm btn btn-primary" href="/albums/comments">Cancel</a></p>
</section>

<div class="col-md-4">
	<?php if ($this->isAdmin()) :?>
	<aside id="admin-panel">
		<div class="panel panel-default">
			<div class="panel-heading">Admin panel for Commnets</div>
			<div class="panel-body">
				<a class="btn btn-primary btn-sm" href="/albums/comments/edit/<?=$comment['id'] ?>">Edit</a>
				<a class="btn btn-primary btn-sm" href="/albums/comments/delete/<?=$comment['id'] ?>">Delete</a>
			</div>
		</div>
		</aside>
	<?php endif; ?>
</div>