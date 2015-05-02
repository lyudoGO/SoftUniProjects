<h3>Edit Song</h3>

<?php if ($model) { ?>
<form method="post" action="/albums/songs/edit/<?= $model['id'] ?>">
    Song name: <input type="text" name="song-name" value="<?= htmlspecialchars($model['name']) ?>"/><br/>
    Artist name: <input type="text" name="artist" value="<?= htmlspecialchars($model['artist']) ?>"/><br/>
    Duration: <input type="text" name="duration" value="<?= htmlspecialchars($model['duration']) ?>"/><br/>
    <input type="submit" value="Edit">
    <a href="/albums/songs">[Cancel]</a>
</form>
<?php } ?>