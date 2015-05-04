<section id="home">
	<h3>List Genres</h3>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
		<?php foreach ($genres as $genre) :?>
			<tr>
				<td><?= htmlspecialchars($genre['id']); ?></td>
				<td><?= htmlspecialchars($genre['name']); ?></td>
				<td><a href="/albums/genres/view/<?=$genre['id'] ?>">[View]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<p><a href="/albums/genres/create">[Create new genre]</a></p>
	<ul id="pagging">
		<li><a href="/albums/genres/index/<?= ($this->page <= 1) ? 1 : $this->page - 1; ?>/<?= $this->pageSize; ?>">[Previous]</a></li>
		<li><a href="/albums/genres/index/<?= $this->page + 1; ?>/<?= $this->pageSize; ?>">[Next]</a></li>
	</ul>
</section>