<div>
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
		<ul>
		<li><a href="/albums/genres/create">[Create new genre]</a></li>
	</ul>
</div>