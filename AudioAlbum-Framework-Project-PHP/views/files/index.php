<div>
	<h3>List files</h3>
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Size</th>
			<th>Mime</th>
		</tr>
		<?php foreach ($files as $file) :?>
			<tr>
				<td><?php echo $file['id']; ?></td>
				<td><?php echo $file['name']; ?></td>
				<td><?php echo $file['size']; ?></td>
				<td><?php echo $file['mime']; ?></td>
				<td><a href="/albums/files/delete/<?=$file['id'] ?>">[Delete]</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>