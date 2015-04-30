<h1>Add Comment</h1>

<?php if ($playlist_id) { ?>
<form method="post" action="/albums/comments/playlist/<?= $playlist_id ?>">
    Text: <input type="text" name="comment-text" />
    <br/>
    <input type="submit" value="Add Comment">
    <a href="/albums/playlists">[Cancel]</a>
</form>
<?php } ?>