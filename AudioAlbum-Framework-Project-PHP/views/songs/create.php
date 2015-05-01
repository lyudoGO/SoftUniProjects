<h1>Create New Song</h1>

<form method="post" action="/albums/songs/create">
    Song name: <input type="text" name="song-name" />
    Artist name: <input type="text" name="artist-name" />
    Duration: <input type="text" name="duration" />
    <br/>
    <input type="submit" value="Create">
    <a href="/albums/songs">[Cancel]</a>
</form>
