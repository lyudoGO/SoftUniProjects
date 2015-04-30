<h1>Add Comment</h1>

<?php if ($song_id) { ?>
<form method="post" action="/albums/comments/song/<?= $song_id ?>">
    Text: <input type="text" name="comment-text" />
    <br/>
    <input type="submit" value="Add Comment">
    <a href="/albums/songs">[Cancel]</a>
</form>
<?php } ?>