<h1>Upload Song File</h1>

<?php if ($song_id) { ?>
<form method="post" action="/albums/files/upload/<?= $song_id ?>" enctype="multipart/form-data">
    <input type="file" name="uploaded-file" />
    <br/>
    <input type="submit" value="Upload file">
    <a href="/albums/files">[Cancel]</a>
</form>
<?php } ?>