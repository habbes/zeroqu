
<?php
$allowEdit = $data->election->isPending();

?>

<div class="col-md-8">
<ul class="nav nav-tabs">
	
	  <li class="<?=$data->selectedTab == 'sent'?'active':''?>"><a href="<?=$data->electionUrl?>/voters/sent"><i class="fa fa-check"></i> Sent <span class="badge" style="background-color: #777"><?=$data->sentCount?></span></a></li>
	  <li class="<?=$data->selectedTab == 'failed'?'active':''?>"><a href="<?=$data->electionUrl?>/voters/failed"><i class="fa fa-times"></i> Failed <span class="badge" style="background-color: #777"><?=$data->failedCount?></span></a></li>
	  <li class="<?=$data->selectedTab == 'registered'?'active':''?>"><a href="<?=$data->electionUrl?>/voters/registered"><i class="fa fa-sign-in"></i> Registered <span class="badge" style="background-color: #777"><?=$data->registeredCount?></span></a></li>
	  <li class="<?=$data->selectedTab == 'all'?'active':''?>"><a href="<?=$data->electionUrl?>/voters/all"><i class="fa fa-check"></i> <i class="fa fa-times"></i> <i class="fa fa-sign-in"></i> All <span class="badge" style="background-color: #777"><?=$data->allCount?></span></a></li>
	</ul>
<?php if(!$data->voters){?>
	<?php if($data->selectedTab == "sent"){ ?>
		<?php if($data->isSearch){ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no sent emails with characters you searched for.</p>
		<?php }else{ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no emails sent yet.</p>
		<?php } ?>
	<?php }else if($data->selectedTab == "registered"){ ?>
		<?php if($data->isSearch){ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no registered emails with characters you searched for.</p>
		<?php }else{ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no emails registered yet.</p>
		<?php } ?>
	<?php }else if($data->selectedTab == "failed"){ ?>
		<?php if($data->isSearch){ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no failed emails with characters you searched for.</p>
		<?php }else{ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no failed emails.</p>
		<?php } ?>
	<?php }else if($data->selectedTab == "all"){ ?>
		<?php if($data->isSearch){ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no emails with characters you searched for.</p>
		<?php }else{ ?>
			<p style="padding-top: 20px; padding-bottom: 20px">There are no emails. Use the panel on the left to add voters.</p>
		<?php } ?>
	<?php }?>
<?php }else{ ?>

<div class="col-md-12" >
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px">
				<div class="col-md-5" style="">
					<form action="" class="form" method="POST">
						<div class="form-group">
							<input type="hidden" value="<?=$data->selectedTab?>" name="selected">
							<button type="submit" class="btn btn-default"><i class="fa fa-reply"></i> Resend emails</button>
						</div>
					</form>
				</div>
				<div class="col-md-7">
					<form class="form">
						<div class="input-group">
							<input type="search" name="q" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
						      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
						    </span>
						</div>
					</form>
				</div>
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
					<form method="post" class="form-inline" action="<?= $data->electionUrl?>/voters#">
						<input type="hidden" name="id" value="<?= $voter->getId() ?>"/>
						<span class="col-md-9 col-xs-7" style="border-bottom: solid 1px #ddd" >
						<input type="email" name="email" class="inputarea col-md-12 col-xs-12" value="<?= $voter->getEmail() ?>" /></span>
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
	<ul class="pagination">
	  <li><a href="<?=$data->previousPageUrl?><?=$data->isSearch?"&q=" . $data->niddle:""?>"><i class="fa fa-angle-double-left"></i> Previous</a></li>
	  <li class="<?=$data->theEnd?"active":""?>"><a href="<?=$data->nextPageUrl?><?=$data->isSearch?"&q=" . $data->niddle:""?>">Next <i class="fa fa-angle-double-right"></i></a></li>
	</ul>
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
		<textarea class="form-control" name="emails" rows="1" placeholder="Emails"></textarea>
	</div>
	<?php
		
	 	foreach($data->election->getCustomProperties() as $property){ ?>
			 <div class="form-group">
				<label style="text-transform: capitalize"><?=$property->name?></label>
				<input class="form-control" name="<?=$property->name?>" placeholder="<?=$property->name?>"  required>
			</div>
	<?php } ?>
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

