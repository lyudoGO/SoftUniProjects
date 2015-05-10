<section id="home">
	<form method="post" action="/albums/account/edit" class="form-horizontal">
	  <fieldset>
	    <legend>Edit Account</legend>
	    <div class="form-group">
			<label for="inputUsername" class="col-lg-2 control-label">Username</label>
			<div class="col-lg-6">
				<input type="text" class="form-control input-sm" id="inputUsername" placeholder="Username" name="username" value="<?= $user['username']; ?>" required>
			</div>
	    </div>
	    <div class="form-group">
			<label for="inputPassword" class="col-lg-2 control-label">Password</label>
			<div class="col-lg-6">
				<input type="password" class="form-control input-sm" id="inputPassword" placeholder="Password" name="password" required>
			</div>
	    </div>
	    <div class="form-group">
			<label for="inputEmail" class="col-lg-2 control-label">Email</label>
			<div class="col-lg-6">
				<input type="text" class="form-control input-sm" id="inputEmail" placeholder="Email" name="email" value="<?= $user['email']; ?>" />
			</div>
	    </div>
	    <div class="form-group">
	      <label for="inputFullname" class="col-lg-2 control-label">Fullname</label>
			<div class="col-lg-6">
				<input type="text" class="form-control input-sm" id="inputFullname" placeholder="Fullname" name="fullname" value="<?= $user['fullname']; ?>" />
			</div>
	    </div>
	    <div class="form-group">
			<div class="col-lg-6 col-lg-offset-2">
				<button type="submit" class="btn-sm btn btn-primary">Edit account</button>
				<a href="/albums/home" class="btn-sm btn btn-primary" type="reset" role="button">Cancel</a>
			</div>
	    </div>
	  </fieldset>
	</form>
</section>