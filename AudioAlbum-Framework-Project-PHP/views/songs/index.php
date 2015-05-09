<section id="home">
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="post" action="/albums/songs/search" class="form-horizontal">
			    <div class="form-group">
			        <label for="inputSong" class="col-lg-2">Filter by song</label>
			        <div class="col-lg-4">
			        	<p><input type="text" id="inputSong" placeholder="Song..." name="song-name" value="<?= htmlspecialchars($this->filter); ?>" />
						<input type="submit" value="Filter"></p>
			        </div>
			        <label for="inputGenre" class="col-lg-2">Filter by genre</label>
			        <div class="col-lg-4">
			        	<p><input type="text" id="inputGenre" placeholder="Genre..." name="genre-name" value="<?= htmlspecialchars($this->genreName); ?>" />
						<input type="submit" value="Filter"></p>
			        </div>
			    </div>
			</form>
		</div>
	</div>
	<div class="panel panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">List Songs</h3>
	    </div>
	    <div class="panel-body">
			<ul class="list-group">
				<?php foreach ($songs as $song) :?>
				<li class="list-group-item">
					<span class="label label-primary col-sm-2"><?= htmlspecialchars($song['genre_name']); ?></span>		
					<span class="badge glyphicon glyphicon-thumbs-down"><?= htmlspecialchars($song['dislikes']); ?></span>
					<span class="badge glyphicon glyphicon-thumbs-up"><?= htmlspecialchars($song['likes']); ?></span>
					<a class="col-sm-4" href="/albums/songs/view/<?=$song['id'] ?>" ><?= htmlspecialchars($song['name']); ?></a>
					<a class="btn btn-primary btn-xs" href="/albums/files/download/<?=$song['id'] ?>">Download</a>
					<a class="btn btn-primary btn-xs" href="/albums/files/listen/<?=$song['id'] ?>">Listen</a>
					
				</li>
				<?php endforeach; ?>
			</ul>
	    </div>
	</div>
	<p><a class="btn btn-primary btn-sm" href="/albums/songs/create">Create song</a></p>
	<ul class="pager" id="pagging">
		<li><a class="btn-sm" href="/albums/songs/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">Previous</a></li>
		<li><a class="btn-sm" href="/albums/songs/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">Next</a></li>
	</ul>
</section>