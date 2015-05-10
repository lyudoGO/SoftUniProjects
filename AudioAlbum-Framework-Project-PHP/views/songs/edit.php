<?php if ($model) { ?>
    <form method="post" action="/albums/songs/edit/<?= $model['id'] ?>" class="form-horizontal">
      <fieldset>
        <legend>Edit song</legend>
        <div class="form-group">
          <label for="inputSongName" class="col-md-2 control-label">Song Name</label>
          <div class="col-md-6">
            <input type="text" class="form-control input-sm" id="inputSongName" placeholder="Song Name" name="song-name" value="<?= htmlspecialchars($model['name']) ?>" required />
          </div>
        </div>
        <div class="form-group">
          <label for="inputArtist" class="col-md-2 control-label">Artist Name</label>
          <div class="col-md-6">
            <input type="text" class="form-control input-sm" id="inputArtist" placeholder="Artist Name" name="artist" value="<?= htmlspecialchars($model['artist']) ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="inputDuration" class="col-md-2 control-label">Song Duration</label>
          <div class="col-md-6">
            <input type="text" class="form-control input-sm" id="inputDuration" placeholder="Song Duration" name="duration" value="<?= htmlspecialchars($model['duration']) ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="inputLikes" class="col-md-2 control-label">Likes</label>
          <div class="col-md-6">
            <input type="text" class="form-control input-sm" id="inputLikes" placeholder="Likes" name="likes" value="<?= htmlspecialchars($model['likes']) ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="inputDislikes" class="col-md-2 control-label">Dislikes</label>
          <div class="col-md-6">
            <input type="text" class="form-control input-sm" id="inputDislikes" placeholder="Dislikes" name="dislikes" value="<?= htmlspecialchars($model['dislikes']) ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="select" class="col-md-2 control-label">Genre Name</label>
          <div class="col-md-6">
            <select class="form-control input-sm" id="select" name="genres">
              <option value=""></option>
                <?php foreach ($genres as $genre) :?>
                    <option value="<?= htmlspecialchars($genre['id']); ?>"><?= htmlspecialchars($genre['name']); ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-2">
            <button type="submit" class="btn btn-primary btn-sm">Edit Song</button>
            <a href="/albums/songs" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
          </div>
        </div>
      </fieldset>
    </form>
<?php } ?>