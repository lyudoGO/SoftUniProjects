<section id="home">

	<form method="post" action="/albums/files/upload/<?= $songId ?>" enctype="multipart/form-data" class="form-horizontal">
	  <fieldset>
	    <legend>Upload Song File</legend>
	    <div class="form-group">
	      <div class="col-lg-6">
	        <input type="file" name="uploaded-file" />
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-lg-6 col-lg-offset-2">
	        <button type="submit" class="btn btn-primary btn-sm">Upload file</button>
	        <a href="/albums/songs/view/<?= $songId; ?>" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
	      </div>
	    </div>
	  </fieldset>
	</form>

</section>