<h3>Edit Playlist</h3>

<?php if ($model) { ?>
<form method="post" action="/albums/playlists/edit/<?= $model['id'] ?>">
    Playlist name: <input type="text" name="playlist-name" value="<?= htmlspecialchars($model['name']) ?>"/>
    <br/>
    <input type="submit" value="Edit">
    <a href="/albums/playlists">[Cancel]</a>
</form>
<?php } ?>