<h1>Add Comment</h1>

<?php if ($song_id) { ?>
<form method="post" action="/albums/comments/song/<?= $song_id ?>">
    Comment: <textarea rows="4" cols="50" name="comment-text" autofocus></textarea>
    <br/>
    <input type="submit" value="Add Comment">
    <a href="/albums/songs">[Cancel]</a>
</form>
<?php } ?>