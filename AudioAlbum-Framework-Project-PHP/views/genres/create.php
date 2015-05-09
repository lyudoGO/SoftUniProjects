<section id="home">
<?php if (true) { ?>
	<form method="post" action="/albums/genres/create" class="form-horizontal">
	  <fieldset>
	    <legend>Create New Genre</legend>
	    <div class="form-group">
	      <label for="inputGenreName" class="col-lg-2 control-label">Genre name</label>
	      <div class="col-lg-6">
	        <input type="text" class="form-control input-sm" id="inputGenreName" placeholder="Genre..." name="genre-name" required />
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-lg-6 col-lg-offset-2">
	        <button type="submit" class="btn btn-primary btn-sm">Create</button>
	        <a href="/albums/genres" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>
<?php } ?>
</section>