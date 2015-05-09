<section id="home">
	<div class="panel panel-primary">
	    <div class="panel-heading">
	      <h3 class="panel-title">List Comments</h3>
	    </div>
	    <div class="panel-body">
			<div class="list-group">
				<?php foreach ($comments as $comment) :?>				
					<a href="/albums/comments/view/<?=$comment['id'] ?>" class="list-group-item"><?= htmlspecialchars($comment['text']); ?>
					</a>
				<?php endforeach; ?>
			</div>
	    </div>
	</div>
	<ul class="pager" id="pagging">
		<li><a class="btn-sm" href="/albums/comments/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">Previous</a></li>
		<li><a class="btn-sm" href="/albums/comments/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">Next</a></li>
	</ul>
</section>