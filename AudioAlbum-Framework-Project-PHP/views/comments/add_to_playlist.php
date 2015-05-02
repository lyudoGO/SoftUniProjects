<h1>Add Comment</h1>

<?php if ($playlist_id) { ?>
<form method="post" action="/albums/comments/playlist/<?= $playlist_id ?>">
    Comment: <textarea rows="4" cols="50" name="comment-text" autofocus></textarea><br/>
    <input type="submit" value="Add Comment">
    <a href="/albums/playlists">[Cancel]</a>
</form>
<?php } ?>