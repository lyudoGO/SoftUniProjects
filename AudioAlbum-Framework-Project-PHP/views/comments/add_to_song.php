<section id="home">
<?php if ($song_id) { ?>
	<form method="post" action="/albums/comments/song/<?= $song_id; ?>" class="form-horizontal">
	  <fieldset>
	    <legend>Add Comment</legend>
	    <div class="form-group">
	        <label for="inputGenreName" class="col-lg-2 control-label">Text for song:</label>
			<div class="col-lg-6">
				<textarea rows="4" cols="50" name="comment-text" placeholder="Comment here..." autofocus></textarea>
			</div>
	    </div>
	    <div class="form-group">
	      <div class="col-lg-6 col-lg-offset-2">
	        <button type="submit" class="btn btn-primary btn-sm">Add commnet</button>
	        <a href="/albums/songs/view/<?= $song_id ?>" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>
<?php } ?>
</section>