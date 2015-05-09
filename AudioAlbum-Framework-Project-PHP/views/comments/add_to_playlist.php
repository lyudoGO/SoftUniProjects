<section id="home">
<?php if ($playlist_id) { ?>
	<form method="post" action="/albums/comments/playlist/<?= $playlist_id; ?>" class="form-horizontal">
	  <fieldset>
	    <legend>Add Comment</legend>
	    <div class="form-group">
	        <label for="inputGenreName" class="col-lg-2 control-label">Text for playlist:</label>
			<div class="col-lg-6">
				<textarea rows="4" cols="50" name="comment-text" placeholder="Comment here..." autofocus></textarea>
			</div>
	    </div>
	    <div class="form-group">
	      <div class="col-lg-6 col-lg-offset-2">
	        <button type="submit" class="btn btn-primary btn-sm">Add commnet</button>
	        <a href="/albums/songs/view/<?= $playlist_id ?>" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>
<?php } ?>
</section>