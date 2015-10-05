<?php 
$allowEdit = $data->election->isPending();
print_r($data); exit;
?>

<div class="col-md-8">
<ul class="nav nav-tabs">
	  <li class="<?=$data->selectedTab == 'sent'?'active':''?>"><a href="#">Sent</a></li>
	  <li class="<?=$data->selectedTab == 'failed'?'active':''?>"><a href="#">Failed</a></li>
	  <li class="<?=$data->selectedTab == 'registered'?'active':''?>"><a href="#">Registered</a></li>
	  <li class="<?=$data->selectedTab == 'all'?'active':''?>"><a href="#">All</a></li>
	</ul>
<?php if(!$data->voters){?>
	<div class="col-md-12" >
		<div class="row">
			<p>No voters found. Use the form on the right to add voters.</p>
		</div>
	</div>
<?php }else{ ?>

<div class="col-md-12" >
	<div class="row">
	
	<?php foreach($data->voters as $voter){ ?>
		
			<form method="post" class="form-inline" action="<?= $data->election->getName()?>/voters#">
				<input type="hidden" name="id" value="<?= $voter->getId() ?>"/>
				<span class="col-md-9 col-xs-7" style="border-bottom: solid 1px #ddd" >
				<input type="email" name="email" class="votersEmail" value="<?= $voter->getEmail() ?>" required/></span>
				<span class="col-md-1 col-xs-1" style="border-bottom: solid 1px #ddd" >
					<span class="icon-wrapper" style="font-size: 21.4px" title="<?=$msg?>">
  							<i class="fa <?=$icon?>"></i>
					</span>
				</span>
				<?php if($allowEdit) {?>
				<span class="col-md-1 col-xs-1"  style="border-bottom: solid 1px #ddd" ><button name="resend" class="icon-wrapper"><i class="fa fa-paper-plane" title="Resend Email"></i></button></span>
				<span class="col-md-1 col-xs-1"  style="border-bottom: solid 1px #ddd" ><button name="delete" class="icon-wrapper"><i class="fa fa-trash-o" title="Unregister user"></i></button></span>
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

<form method="post" class="form">
	<div style="font-size: 1.1em"><strong>
	<span data-toggle="popover" title="Add voters" data-placement="bottom" data-content="Enter the email addresses of the  voters below.Each voter will be assigned a unique Voter ID and a Password.You can optional set the string that will prefix each Voter ID.">Add voters
		<small class="fa-stack" style="font-size:small">
  			<i class="fa fa-circle fa-stack-2x"></i>
  			<i class="fa fa-question fa-stack-1x fa-inverse"></i>
		</small>
	</span>
	</strong></div>

	<div class="form-group">
		<label>Prefix</label>
		<?php 
			$prefix = $data->election->getPrefix();
		?>
		<input type="text" class="form-control" name="prefix" value="<?= $prefix ?>" <?= $prefix? "disabled" : ""?>/>
	</div>
	<div class="form-group">
		<label>Upload file</label>
		<input type="file" name="file">
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

