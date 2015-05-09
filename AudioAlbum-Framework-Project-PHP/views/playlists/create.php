	<form method="post" action="/albums/playlists/create" class="form-horizontal">
	  <fieldset>
	    <legend>Create New Playlist</legend>
	    <div class="form-group form-group-sm">
	      <label for="inputUsername" class="col-lg-2 control-label">Playlist name</label>
	      <div class="col-lg-4">
	        <input type="text" class="form-control input-sm" id="inputUsername" placeholder="Playlist..." name="playlist-name" required />
	      </div>
	    </div>
	    <div class="form-group form-group-sm">
	      <div class="col-lg-4 col-lg-offset-2">
	        <button type="submit" class="btn-sm btn btn-primary">Create</button>
	        <a href="/albums/playlists" class="btn-sm btn btn-primary" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>