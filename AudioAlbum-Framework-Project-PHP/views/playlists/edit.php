<section id="home">
<?php if ($model) { ?>
	<form method="post" action="/albums/playlists/edit/<?= $model['id'] ?>" class="form-horizontal">
	  <fieldset>
	    <legend>Edit playlist</legend>
	    <div class="form-group">
	      <label for="inputPlaylistName" class="col-lg-2 control-label">Playlist name</label>
	      <div class="col-lg-6">
	        <input type="text" class="form-control" id="inputPlaylistName" placeholder="Playlist Name" name="playlist-name" value="<?= htmlspecialchars($model['name']) ?>" required />
	      </div>
	    </div>
	    <div class="form-group">
	      <label for="inputLikes" class="col-lg-2 control-label">Likes</label>
	      <div class="col-lg-6">
	        <input type="text" class="form-control" id="inputLikes" placeholder="Likes" name="likes" value="<?= htmlspecialchars($model['likes']) ?>" />
	      </div>
	    </div>
	    <div class="form-group">
	      <label for="inputDilikes" class="col-lg-2 control-label">Dislikes</label>
	      <div class="col-lg-6">
	        <input type="text" class="form-control" id="inputDilikes" placeholder="Dilikes" name="dislkies" value="<?= htmlspecialchars($model['dislikes']) ?>" />
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-lg-6 col-lg-offset-2">
	        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
	        <a href="/albums/playlists" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>
<?php } ?>
</section>