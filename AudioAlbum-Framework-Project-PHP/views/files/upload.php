<h1>Upload Song File</h1>

<?php if ($songId) { ?>
<form method="post" action="/albums/files/upload/<?= $songId ?>" enctype="multipart/form-data">
    <input type="file" name="uploaded-file" />
    <br/>
    <input type="submit" value="Upload file">
    <a href="/albums/songs">[Cancel]</a>
</form>
<?php } ?>