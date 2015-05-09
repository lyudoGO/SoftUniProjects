<section id="home">
<?php if ($model) { ?>
	<form method="post" action="/albums/genres/edit/<?= $model['id']; ?>" class="form-horizontal">
	  <fieldset>
	    <legend>Edit genre</legend>
	    <div class="form-group">
	      <label for="inputGenreName" class="col-lg-2 control-label">Genre name</label>
	      <div class="col-lg-6">
	        <input type="text" class="form-control input-sm" id="inputGenreName" placeholder="Genre..." name="genre-name" value="<?= htmlspecialchars($model['name']); ?>" required />
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-lg-6 col-lg-offset-2">
	        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
	        <a href="/albums/genres" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>
<?php } ?>
</section>