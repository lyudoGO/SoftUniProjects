<div>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
		</tr>
		<?php foreach ($genres as $genre) :?>
			<tr>
				<td><?php echo $genre['id']; ?></td>
				<td><?php echo $genre['name']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>