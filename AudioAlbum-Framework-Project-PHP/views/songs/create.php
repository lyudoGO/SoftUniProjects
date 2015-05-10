    <form method="post" action="/albums/songs/create" class="form-horizontal">
      <fieldset>
        <legend>Create new song</legend>
        <div class="form-group form-group-sm">
          <label for="inputSongName" class="col-lg-2 control-label">Song Name</label>
          <div class="col-lg-4">
            <input type="text" class="form-control input-sm" id="inputSongName" placeholder="Song Name" name="song-name" required />
          </div>
        </div>
        <div class="form-group form-group-sm">
          <label for="inputArtist" class="col-lg-2 control-label">Artist Name</label>
          <div class="col-lg-4">
            <input type="text" class="form-control input-sm" id="inputArtist" placeholder="Artist Name" name="artist-name" required />
          </div>
        </div>
        <div class="form-group form-group-sm">
          <label for="inputDuration" class="col-lg-2 control-label">Song Duration</label>
          <div class="col-lg-4">
            <input type="text" class="form-control input-sm" id="inputDuration" placeholder="Song Duration" name="duration" />
          </div>
        </div>
        <div class="form-group form-group-sm">
          <label for="select" class="col-lg-2 control-label">Genre Name</label>
          <div class="col-lg-4">
            <select class="form-control input-sm" id="select" name="genres">
                 <option value=""></option>
                <?php foreach ($genres as $genre) :?>
                    <option value="<?= htmlspecialchars($genre['id']); ?>"><?= htmlspecialchars($genre['name']); ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group form-group-sm">
          <div class="col-lg-4 col-lg-offset-2">
            <button type="submit" class="btn btn-sm btn-primary">Create</button>
            <a href="/albums/songs" class="btn btn-sm btn-primary" type="reset" role="button">Cancel</a>
          </div>
        </div>
      </fieldset>
    </form>
