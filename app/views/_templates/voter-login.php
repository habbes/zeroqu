<div class="container">
	<div class="row">
		<div class="">
			<div class="panel">
				<div class="panel-body">
					<div class="col-md-7">
					<h2 class="section-title title-underline">zero<span class="logo-q">Q</span>u <span class="logo-q">voter</span></h2>
					<h4 class="logo">Institution: <span class="logo-q"><?= $data->org->getTitle() ?></span></h4>
					<h4 class="logo">Elections: <span class="logo-q"><?= $data->election->getTitle() ?></span></h4>

					<p>
					Log in using the Voter ID and Password sent to your email. If you encounter any problems logging in,
					ask your elections' administrator to send you new credentials.
					</p>
					</div>

					<div class="col-md-5">
						<?php if($data->loginError){?>
						<p class="alert alert-danger">
							<?= $data->loginError ?>
						</p>
						<?php } ?>
						<form class="form" method="post">
							<div class="form-group">
								<label>Voter ID</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" value="<?= $data->voterId ?>" name="id" class="form-control" required>
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
								<button class="btn btn-success form-control"><i class="fa fa-sign-in"></i> Login</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		
	</div>
</div>



