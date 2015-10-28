<div class="container page">
	<div class="row">
		<div class="col-md-7">
			<div class='intro-title section-title'><span class="logo">zero<span class="logo-q">Q</span>u</span>
				<span class="logo-subtext">elections</span></div>
			<div class="intro-big">
			Comprehensive online election management service.
			</div>
			<br><br>
			<div class="intro-mid">
			<a class="btn btn-primary btn-lg">Learn More</a>
			</div>
		</div>
		<div class="col-md-5">
			<ul id="formtabs" class="nav nav-tabs">
			    <li class="active"><a href="#signin" data-toggle="pill">Existing User</a></li>
			    <li class=""><a href="#signup" data-toggle="pill">New User</a></li>
			</ul>
			<div class="tab-content">
				<div id="signin" class="panel tab-pane fade in active">
					<div class="panel-body">
						<?php if($data->loginError) { ?>
						<p class="alert alert-danger"><?= $data->loginError ?></p>
						<?php } ?>
						<form class="form" method="post" action="admin-login">
							<div class="form-group">
								<label>Email</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="email" name="username" class="form-control" value="<?= $data->loginUsername?>" required>
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-success form-control"><i class="fa fa-sign-in"></i> Log In</button>
							</div>
						</form>
					</div>
				</div>
				<div id="signup" class="panel tab-pane fade">
					<div class="panel-body">
						<?php if($data->signupErrors) { ?>
						
							<ul class="alert alert-danger">
								<?php foreach($data->signupErrors as $error) { ?>
								Account creation failed due to following errors:
								<li><?= $error ?></li>
								<?php } ?>
							</ul>
						
						<?php } ?>
						<form class="form" method="post" action="new-account">
							<div class="form-group">
								<label>Organization Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-university"></i></span>
									<input type="text" name="title" class="form-control" value="<?= $data->signupOrgTitle ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label>Unique Identifier</label>
								<div class="input-group">
									<span class="input-group-addon"><?= URL_ROOT ?>/orgs/</span>
									<input type="text" name="name" class="form-control" value="<?= $data->signupOrgName ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label>Administrator's Email</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="email" name="username" value="<?= $data->signupUsername ?>" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="confirm-password" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-success form-control"><i class="fa fa-plus-circle"></i> Create Account</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</div>