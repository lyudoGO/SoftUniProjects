<h1>Upload New Song</h1>

<form method="post" action="/albums/songs/upload" enctype="multipart/form-data">
    Song name: <input type="text" name="song-name" />
    Artist name: <input type="text" name="artist-name" />
    Genre name: <input type="text" name="genre-name" />
    <input type="file" name="uploaded-file" />
    <br/>
    <input type="submit" value="Upload file">
    <a href="/albums/songs">[Cancel]</a>
</form>
