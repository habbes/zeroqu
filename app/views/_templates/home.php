
	<div id="menu-container">
		<div class="menu" id="voter-menu">
			<div class="head">
				<h2>Voter</h2>
			</div>
			<div class="content">
				<div class="description">
					Enter to cast vote or view candidates.
				</div>
				<div class="form login-form">
					<form method="post">
						<input type="hidden" name="form" value="voter-login"/>
						<div>
							<div class="form-row">
								<label>Election ID</label>
								<input class="field" name="election" type="text" />
							</div>
							<div class="form-row">
								<label>Voter ID</label>
								<input class="field" name="voter" type="text" />
							</div>
							<div class="form-row">
								<label>Password</label>
								<input class="field" name="password" type="password" />
							</div>
						</div>
						<div class="form-buttons">
							<input class="button" type="submit" value="Enter"/>
						</div>
						<p>
							<?= $data->voterLoginResult ?>
						</p>
					</form>
				</div>
			</div>
		</div>
		<div class="menu" id="admin-menu">
			<div class="head">
				<h2>Admin</h2>
			</div>
			<div class="content">
				<div class="description">
					Enter to create or manage elections.
				</div>
				<div class="form login-form" id="admin-login">
					<form method="post">
						<input type="hidden" name="form" value="admin-login"/>
						<div>
							<div class="form-row">
								<label>Username</label>
								<input class="field" name="username" type="text"/>
							</div>
							<div class="form-row">
								<label>Password</label>
								<input class="field" name="password" type="password" />
							</div>
						</div>
						<div class="form-buttons">
						<input class="button" type="submit" value="Sign In"/>
						<span class="form-select"><span class="or">or</span> Sign Up</span>
						</div>
						<p>
							<?= $data->loginResult ?>
						</p>
						
					</form>
				</div>
				<div class="form" id="admin-signup">
					<form method="post" >
						<input type="hidden" name="form" value="admin-signup"/>
						<div>
							<div class="form-row">
								<label>Username</label>
								<input class="field" name="username" type="text"/>
							</div>
							<div class="form-row">
								<label>Password</label>
								<input class="field" name="password" type="password"/>
							</div>
							<div class="form-row">
								<label>Confirm</label>
								<input class="field" name="confirm_password" type="password"/>
							</div>
						</div>
						<div class="form-buttons">
						<input class="button" type="submit" value="Sign Up"/>
						<span class="form-select"><span class="or">or</span> Sign In</span>
						</div>
						<div class="form-row">
							<span class="error"><?= $data->signupError; ?></span>
						</div>
						<p>
							<?= $data->signupResult ?>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		var descs = document.getElementsByClassName("description");
		var desc;
		for(var i = 0; i < descs.length; i++){
			desc = descs[i];
			desc.onclick = function(){
				var par = this.parentNode;
				var form = par.getElementsByClassName("login-form")[0];
				form.style.display = "block";
				this.style.display = "none";
			};
		}

		var adminLogin = document.getElementById("admin-login");
		var adminSignup = document.getElementById("admin-signup");

		function switchAdminForm(){
			if(adminLogin.style.display == "block"){
				adminLogin.style.display = "none";
				adminSignup.style.display = "block";
			}
			else {
				adminLogin.style.display = "block";
				adminSignup.style.display = "none";
			}
		}

		var fs = document.getElementsByClassName("form-select");
		for(var i = 0; i < fs.length; i++){
			fs[i].onclick = switchAdminForm;
		}
		
	</script>
	
