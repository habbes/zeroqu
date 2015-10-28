<!doctype html>
<html lang="en">
<head>
	<title>zeroQu Election Manager</title>
	<base href="<?= URL_ROOT ?>">
	<link href="public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
	        	<span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		    </button>
	      	<a class="navbar-brand logo" href="#">zero<span class="logo-q">Q</span>u</a>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="#">About</a></li>
				<li class="active dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <i class="fa fa-caret-down"></i></a>
					<ul class="dropdown-menu">
						<li><a href="#">One</a></li>
						<li><a href="#">Two</a></li>
						<li><a href="#">Three</a></li>
					</ul>
				</li>
				<li><a href="#">Pricing</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<i class="fa fa-user"></i> username <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href='#'>Profile</a></li>
						<li class="divider"></li>
						<li><a href='#'>Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>


	</div>
</nav>

<div id="page-body">
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
</div>



<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
$('#formtabs a').click(function(e){
	e.preventDefault();
	$(this).tab('show');
})
</script>

</body>

</html>