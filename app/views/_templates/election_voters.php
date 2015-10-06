<?php 
$allowEdit = $data->election->isPending();

?>

<div class="col-md-8">
<ul class="nav nav-tabs">
	  <li class="<?=$data->selectedTab == 'sent'?'active':''?>"><a href="<?=$data->election->getName()?>/voters/sent"><i class="fa fa-check"></i> Sent</a></li>
	  <li class="<?=$data->selectedTab == 'failed'?'active':''?>"><a href="<?=$data->election->getName()?>/voters/failed"><i class="fa fa-times"></i> Failed</a></li>
	  <li class="<?=$data->selectedTab == 'registered'?'active':''?>"><a href="<?=$data->election->getName()?>/voters/registered"><i class="fa fa-sign-in"></i> Registered</a></li>
	  <li class="<?=$data->selectedTab == 'all'?'active':''?>"><a href="<?=$data->election->getName()?>/voters/all"><i class="fa fa-check"></i> <i class="fa fa-times"></i> <i class="fa fa-sign-in"></i> All</a></li>
	</ul>
<?php if(!$data->voters){?>
	<p>No voters found. Use the form on the right to add voters.</p>
<?php }else{ ?>

<div class="col-md-12" >
	<div class="row">
		<div class="col-md=12">
			<div class="row">
				<div class="col-md-12" style="padding-top: 10px;padding-bottom: 10px">
					<form action="" class="form" method="POST">
						<div class="form-group">
							<input type="hidden" value="<?=$data->selectedTab?>" name="selected">
							<button type="submit" class="btn btn-default"><i class="fa fa-reply"></i> Resend emails</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php foreach($data->voters as $voter){ ?>
			<?php if($data->selectedTab == 'all'){
				switch($voter->getStatus()){
					case Voter::EMAIL_SENT:
						$icon = 'fa-check';
						$msg = 'Email sent successfully';
					case Voter::EMAIL_FAILED:
						$icon = 'fa-exclamation-triangle';
						$msg = 'Unable to sent email';
					case Voter::REGISTERED:
						$icon = 'fa-check-circle';
						$msg = 'Email registered successfully';
						
				}
			}else if($data->selectedTab == 'sent'){
				$icon = 'fa-check';
				$msg = 'Email sent successfully';
			}else if($data->selectedTab == 'registered'){
				$icon = 'fa-check-circle';
				$msg = 'Email registered successfully';
			}else if($data->selectedTab == 'failed'){
				$icon = 'fa-exclamation-triangle';
				$msg = 'Unable to sent email';
			}?>
					<form method="post" class="form-inline" action="<?= $data->election->getName()?>/voters#">
						<input type="hidden" name="id" value="<?= $voter->getId() ?>"/>
						<span class="col-md-9 col-xs-7" style="border-bottom: solid 1px #ddd" >
						<input type="email" name="email" class="inputarea col-md-12 col-xs-12" value="<?= $voter->getEmail() ?>" required/></span>
						<span class="col-md-1 col-xs-1" style="border-bottom: solid 1px #ddd" >
							<span class="icon-wrapper" style="font-size: 16px" title="<?=$msg?>">
		  							<i class="fa <?=$icon?>"></i>
							</span>
						</span>
						<?php if($allowEdit) {?>
						<span class="col-md-1 col-xs-1"  style="border-bottom: solid 1px #ddd" ><button name="resend" class="buttons"><i class="fa fa-paper-plane" title="Resend Email"></i></button></span>
						<span class="col-md-1 col-xs-1"  style="border-bottom: solid 1px #ddd" ><button name="delete" class="buttons"><i class="fa fa-trash-o" title="Unregister user"></i></button></span>
						<?php } ?>
					</form>

	<?php } ?>
	</div>
</div>
<?php 
	}
?>

</div>
<?php 
	if($allowEdit){
?>
<div class="col-md-4">

<form method="post" class="form" enctype="multipart/form-data">
	<div style="font-size: 1.1em"><strong>
	<span data-toggle="popover" title="Add voters" data-placement="bottom" data-content="Enter the email addresses of the  voters below.Each voter will use the provided email and an automatically generated Password.">Add voters
		<small class="fa-stack" style="font-size:small">
  			<i class="fa fa-circle fa-stack-2x"></i>
  			<i class="fa fa-question fa-stack-1x fa-inverse"></i>
		</small>
	</span>
	</strong></div>
	<div class="form-group">
		<label>Upload file</label>
		<input type="file" name="csv">
		<span class="help-block">Upload a CSV file containing the voters email addresses</span>
	</div>
	<div class="form-group">
		<label>Voters' Emails</label>
		<textarea class="form-control" name="emails" rows="6" required></textarea>
	</div>
	<div class="form-group">
		<button name="add" class="btn btn-success form-control">Add Voters</button>
	</div>
	<p><?= $data->formResult ?></p>

</form>
<p><?= $data->formResult ?></p>
</div>
<?php 
	}
?>

