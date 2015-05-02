<h3>Create New Song</h3>

<form method="post" action="/albums/songs/create">
    Song name: <input type="text" name="song-name" /><br/>
    Artist name: <input type="text" name="artist-name" /><br/>
    Duration: <input type="text" name="duration" /><br/>
    <input type="submit" value="Create">
    <a href="/albums/songs">[Cancel]</a>
</form>
