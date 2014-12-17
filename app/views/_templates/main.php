
<div id="main-wrapper">
	<div id="top-wrapper">
		<header>
			<span class="title"><a href="home">Elections</a> | <?= Login::isAdminLoggedIn()? "admin" : "voter" ?></span>
			<span id="usercontrol">
			<?php 
				$electionTitle = "";
				if(Login::isVoterLoggedIn()){
					$electionTitle = " - ".$data->election->getTitle();
				}
			?>
				<span class="username"><?= $data->username.$electionTitle?> | <a href="logout" class="signout">sign out</a></span>
			</span>
		</header>
	</div>
	<div id="bottom-wrapper">
		<div id="left-col">
			<div id="menu-wrapper">
				<section>
					<?= $data->menu ?>
				</section>
			</div>
		</div>
		<div id="right-col">
			<div id="content-wrapper">
				<section>
					<?php if($data->contentTitle){?>
						<h2><?= $data->contentTitle ?></h2>
					<?php }?>
					<div>
						<?= $data->content?>
					</div>
				</section>
			</div>
		</div>
		
	</div>
</div>