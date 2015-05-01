<div>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
		<?php foreach ($genres as $genre) :?>
			<tr>
				<td><?= htmlspecialchars($genre['id']); ?></td>
				<td><?= htmlspecialchars($genre['name']); ?></td>
				<td><a href="/albums/genres/edit/<?=$genre['id'] ?>">[Edit]</a></td>
				<td><a href="/albums/genres/delete/<?=$genre['id'] ?>">[Delete]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<ul>
		<li><a href="/albums/genres">[Cancel]</a></li>
	</ul>
</div>