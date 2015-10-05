<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= URL_ROOT ?>">zero<b>Q</b>u</a>
    </div>
    
    <div class="collapse navbar-collapse">
    	<ul class="nav navbar-nav navbar-right">
    		<li><a href="#">Features</a></li>
    		<li><a href="#">Pricing</a></li>
    		<li><a href="#">Help</a></li>    		
    	</ul>
    	
    </div>

</nav>

<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Admin Login</h3>
			</div>
			<div class="panel-body">
				<?php if($data->loginError){ ?>
				<p class="alert alert-danger"><?= $data->loginError ?></p>
				<?php } ?>
				<form class="form" id="signin" method="post">
					<input type="hidden" name="form" value="signin">
					<div class="form-group">
						<label>Username</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="username" class="form-control" value="<?= $data->username ?>" required>
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
						<button class="btn btn-success form-control"><i class="fa fa-sign-in"></i> Sign In</button>
					</div>
				</form>			
			</div>
			</div>
	</div>
</div>