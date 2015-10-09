<div class="container">
	<div class="row">
		<div class="col-md-7">
			<h1 class='section-title'><span class="logo">zero<span class="logo-q">Q</span>u</span> Election Management</h1>
			<p>
				zeroQu is a comprehensive online election management service for institutions.
			</p>
		</div>
		<div class="col-md-5">
			<ul id="formtabs" class="nav nav-pills">
			    <li class="active"><a href="#signin" data-toggle="pill">Existing User</a></li>
			    <li><a href="#signup" data-toggle="pill">New User</a></li>
			</ul>
			<div class="tab-content">
				<div id="signin" class="panel tab-pane fade in active">
					<div class="panel-body">
						<form class="form" method="post">
							<div class="form-group">
								<label>Email</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="email" name="username" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control">
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
						<form class="form" method="post">
							<div class="form-group">
								<label>Organization Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-university"></i></span>
									<input type="text" name="title" class="form-control" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label>Unique Identifier</label>
								<div class="input-group">
									<span class="input-group-addon"><?= URL_ROOT ?>/orgs/</span>
									<input type="text" name="name" class="form-control" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label>Administrator's Email</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="email" name="username" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="confirm-pass" class="form-control">
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