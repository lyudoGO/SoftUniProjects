<h3>Edit Genre</h3>

<?php if ($model) { ?>
<form method="post" action="/albums/genres/edit/<?= $model['id'] ?>">
    Genre name: <input type="text" name="genre-name" value="<?= htmlspecialchars($model['name']) ?>"/>
    <br/>
    <input type="submit" value="Edit">
    <a href="/albums/genres">[Cancel]</a>
</form>
<?php } ?>