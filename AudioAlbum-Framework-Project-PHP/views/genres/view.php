<section id="home">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h2 class="panel-title"><strong>Genre: </strong><?= htmlspecialchars($genres[0]['name']); ?></h2>
		</div>
	    <div class="panel-body">
			<h4>Songs</h4>
			<?php foreach ($genres as $genre) :?>
			<div class="panel panel-info">
				<div class="panel-body text-left">
					<strong><?= htmlspecialchars($genre['song_name']); ?></strong>
					<?php if($genre['song_id']) { 
						echo '<a class="btn-xs btn btn-info" href="/albums/songs/view/<?= $genre["song_id"]; ?>View</a>';
					} else { echo "No songs"; } ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<p><a class="btn-sm btn btn-primary" href="/albums/genres">Cancel</a></p>
</section>
<div class="col-md-4">
<?php if ($this->isAdmin()) :?>
	<aside id="admin-panel">
		<div class="panel panel-default">
			<div class="panel-heading">Admin panel for Genre</div>
			<div class="panel-body">
				<a class="btn btn-primary btn-sm" href="/albums/genres/edit/<?=$genres[0]['id'] ?>">Edit</a>
				<a class="btn btn-primary btn-sm" href="/albums/genres/delete/<?=$genres[0]['id'] ?>">Delete</a>
			</div>
		</div>
		</aside>
	<?php endif; ?>
</div>