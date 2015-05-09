<section id="home">
	<div class="panel panel-default">
	    <div class="panel-heading">
	    	<h3 class="panel-title">Listen song from file: <?= $file['name'];?></h3>
	    </div>
		<div class="panel-body">
			<audio controls autoplay>
			  	<source src="<?php echo '/albums/download/' . $file['name']; ?>" type="audio/mpeg">
				<p>Your browser does not support the audio element.</p>
			</audio>
		</div>
	</div>
	<p><a class="btn btn-primary btn-sm" href="/albums/songs">Cancel</a></p>
</section>