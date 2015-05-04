<div>
	<h3>Listen song from file: <?= $file['name'];?></h3>

	<audio controls autoplay>
	  	<source src="<?php echo '/albums/files/' . $file['name']; ?>" type="audio/mpeg">
		<p>Your browser does not support the audio element.</p>
	</audio>
	<p><a href="/albums/songs">[Cancel]</a></p>
</div>