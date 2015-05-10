<section id="home">
<?php if($this->isAdmin()) :?>
	<h3>List files</h3>
	<table class="table table-condensed">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Size</th>
			<th>Mime</th>
			<th>Song Id</th>
			<th>Song Url</th>
		</tr>
		<?php foreach ($files as $file) :?>
			<tr>
				<td><?php echo $file['id']; ?></td>
				<td><?php echo $file['name']; ?></td>
				<td><?php echo $file['size']; ?></td>
				<td><?php echo $file['mime']; ?></td>
				<td><?php echo $file['song_id']; ?></td>
				<td><?php echo $file['song_url']; ?></td>
				<td><a class="btn btn-primary btn-xs" href="/albums/files/delete/<?=$file['id'] ?>">Delete</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif; ?>
</section>