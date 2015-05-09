<section id="home">
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="post" action="/albums/playlists/search" class="form-horizontal">
			    <div class="form-group">
			        <label for="inputPlaylist" class="col-lg-3">Filter by playlist</label>
			        <div class="col-lg-6">
			        	<p><input type="text" id="inputPlaylist" placeholder="Playlist Name" name="filter-playlist" value="<?= htmlspecialchars($this->filter) ?>" />
						<input type="submit" value="Filter"></p>
			        </div>
			    </div>
			</form>
		</div>
	</div>
	<div class="panel panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">List Playlists</h3>
	    </div>
	    <div class="panel-body">
			<div class="list-group">
				<?php foreach ($playlists as $playlist) :?>				
					<a href="/albums/playlists/view/<?=$playlist['id'] ?>" class="list-group-item"><?= htmlspecialchars($playlist['name']); ?>
						<span class="badge glyphicon glyphicon-thumbs-down"><?= htmlspecialchars($playlist['dislikes']); ?></span>
						<span class="badge glyphicon glyphicon-thumbs-up"><?= htmlspecialchars($playlist['likes']); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
	    </div>
	</div>
	<p><a class="btn btn-primary btn-sm" href="/albums/playlists/create">Create playlist</a></p>
	<ul class="pager" id="pagging">
		<li><a class="btn-sm" href="/albums/playlists/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">Previous</a></li>
		<li><a class="btn-sm" href="/albums/playlists/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">Next</a></li>
	</ul>
</section>