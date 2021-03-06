<section id="home">
	<form method="post" action="/albums/account/register" class="form-horizontal">
	  <fieldset>
	    <legend>Register new user</legend>
	    <div class="form-group">
			<label for="inputUsername" class="col-lg-2 control-label">Username</label>
				<div class="col-lg-4">
				<input type="text" class="form-control input-sm" id="inputUsername" placeholder="Username" name="username" required />
			</div>
	    </div>
	    <div class="form-group">
			<label for="inputPassword" class="col-lg-2 control-label">Password</label>
				<div class="col-lg-4">
				<input type="password" class="form-control input-sm" id="inputPassword" placeholder="Password" name="password" required />
			</div>
	    </div>
	    <div class="form-group">
			<label for="inputEmail" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-4">
				<input type="text" class="form-control input-sm" id="inputEmail" placeholder="Email" name="email" />
			</div>
	    </div>
	    <div class="form-group">
			<label for="inputFullname" class="col-lg-2 control-label">Fullname</label>
				<div class="col-lg-4">
				<input type="text" class="form-control input-sm" id="inputFullname" placeholder="Fullname" name="fullname" />
			</div>
	    </div>
	    <div class="form-group">
			<div class="col-lg-4 col-lg-offset-2">
				<button type="submit" class="btn-sm btn btn-primary">Register</button>
				<a href="/albums/home" class="btn-sm btn btn-primary" type="reset" role="button">Cancel</a>
			</div>
	    </div>
	  </fieldset>
	</form>
</section>