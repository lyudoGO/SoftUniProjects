<section id="home">
<?php if ($model) { ?>
    <form method="post" action="/albums/comments/edit/<?= $model['id'] ?>" class="form-horizontal">
      <fieldset>
        <legend>Edit Comment</legend>
        <div class="form-group">
          <label for="textArea" class="col-md-2 control-label">Commnet Text</label>
          <div class="col-md-6">
            <textarea class="form-control input-sm" rows="4" id="textArea" name="comment-text" autofocus><?= htmlspecialchars($model['text']) ?></textarea>
           </div>
        </div>
        <div class="form-group">
            <label for="selectSong" class="col-md-2 control-label">Song</label>
            <div class="col-md-6">
                <select class="form-control input-sm" id="selectSong" name="song-id">
                    <?php foreach ($songs as $song) :?>
                    <?php foreach ($songs as $song) :?>
                    <?php if($model['song_id'] == $song['id']) { ?>
                    <option selected value="<?= htmlspecialchars($song['id']); ?>"><?= htmlspecialchars($song['name']); ?></option>
                    <?php  } else { ?> 
                    <option value="<?= htmlspecialchars($song['id']); ?>"><?= htmlspecialchars($song['name']); ?></option>
                    <?php } endforeach; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="selectPlaylist" class="col-md-2 control-label">Playlists</label>
            <div class="col-md-6">
                <select class="form-control input-sm" id="selectPlaylist" name="playlist-id">
                    <?php foreach ($playlists as $playlist) :?>
                    <?php if($model['playlist_id'] == $playlist['id']) { ?>
                    <option selected value="<?= htmlspecialchars($playlist['id']); ?>"><?= htmlspecialchars($playlist['name']); ?></option>
                    <?php  } else { ?> 
                    <option value="<?= htmlspecialchars($playlist['id']); ?>"><?= htmlspecialchars($playlist['name']); ?></option>
                    <?php } endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="selectUser" class="col-md-2 control-label">User</label>
            <div class="col-md-6">
                <select class="form-control input-sm" id="selectUser" name="user-id">
                    <?php foreach ($users as $user) : ?>
                    <?php if($model['user_id'] == $user['id']) { ?>
                    <option selected value="<?= htmlspecialchars($user['id']); ?>"><?= htmlspecialchars($user['username']); ?></option>
                    <?php  } else { ?> 
                    <option value="<?= htmlspecialchars($user['id']); ?>"><?= htmlspecialchars($user['username']); ?></option>
                    <?php } endforeach; ?>
                </select>
            </div>
        </div>        
        <div class="form-group">
          <div class="col-md-6 col-md-offset-2">
            <button type="submit" class="btn btn-primary btn-sm">Edit Comment</button>
            <a href="/albums/comments" class="btn btn-primary btn-sm" type="reset" role="button">Cancel</a>
          </div>
        </div>
      </fieldset>
    </form>
<?php } ?>
</section>