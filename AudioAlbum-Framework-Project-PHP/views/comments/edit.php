<h3>Edit Comment</h3>

<?php if ($model) { ?>
<form method="post" action="/albums/comments/edit/<?= $model['id'] ?>">
	Comment text: <textarea rows="4" cols="50" name="comment-text" autofocus><?= htmlspecialchars($model['text']) ?></textarea><br/>
    Song Id: <input type="text" name="song-id" value="<?= htmlspecialchars($model['song_id']) ?>"/><br/>
    Playlist Id: <input type="text" name="playlist-id" value="<?= htmlspecialchars($model['playlist_id']) ?>"/><br/>
    User Id: <input type="text" name="user-id" value="<?= htmlspecialchars($model['user_id']) ?>"/><br/>
    <input type="submit" value="Edit">
    <a href="/albums/comments">[Cancel]</a>
</form>
<?php } ?>