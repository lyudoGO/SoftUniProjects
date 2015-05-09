<section id="home">
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="post" action="/albums/genres/search" class="form-horizontal">
			    <div class="form-group">
			      <label for="inputGenre" class="col-lg-2">Filter by name</label>
			        <div class="col-lg-6">
			        	<p><input type="text" id="inputGenre" placeholder="Genre..." name="genre-name" value="<?= htmlspecialchars($this->filter) ?>" />
						<input type="submit" value="Filter"></p>
			        </div>
			    </div>
			</form>
		</div>
	</div>
	<div class="panel panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">List Genres</h3>
	    </div>
	    <div class="panel-body">
			<div class="list-group">
				<?php foreach ($genres as $genre) :?>				
					<a href="/albums/genres/view/<?=$genre['id'] ?>" class="list-group-item"><?= htmlspecialchars($genre['name']); ?>
					</a>
				<?php endforeach; ?>
			</div>
	    </div>
	</div>
	<?php if($this->isAdmin()) :?>
		<p><a class="btn btn-primary btn-sm" href="/albums/genres/create">Create genre</a></p>
	<?php endif; ?>
	<ul class="pager" id="pagging">
		<li><a class="btn-sm" href="/albums/genres/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">Previous</a></li>
		<li><a class="btn-sm" href="/albums/genres/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">Next</a></li>
	</ul>
</section>