<?php 
$allowEdit = $data->election->isPending();
?>

<div id="content-center">

<?php
	if(!$data->voters){
?>
<p>No voters found. Use the form on the right to add voters.</p>
<?php 
	}
	else {
?>
	<?php if($data->unsent) {?>
	<p style="font-weight:bold;color:red">At least <?= $data->unsent?> emails were not sent successfully.</p>
	<?php }?>
<div class="table" id="voters-table">
	
	<tbody>
	<?php 
		foreach($data->voters as $voter){
			$emailSent = $voter->isEmailSent();
			$iconMsg = $emailSent? "Email sent successfully" : "Email not sent";
			$iconUrl = "warning-24.png";
			switch($voter->getStatus()){
				case Voter::EMAIL_FAILED:
					$iconMsg = "Email not sent";
					$iconUrl = "warning-24.png";
					break;
				case Voter::EMAIL_SENT:
					$iconMsg = "Email sent but not yet registered";
					$iconUrl = "info-24.png";
					break;
				case Voter::REGISTERED:
					$iconMsg = "Voter registered successfully";
					$iconUrl = "tick-icon-24.png";
					break;
			}
	?>
		
			<form class="tr <?= !$emailSent? "email-not-sent" : ""?>" method="post" action="<?= $data->election->getName()?>/voters#">
				<input type="hidden" name="id" value="<?= $voter->getId() ?>"/>
				<span class="td email-column"><input type="text" name="email" value="<?= $voter->getEmail() ?>"/></span>
				<span class="td"><span class="icon-wrapper"><img class="icon" title="<?= $iconMsg ?>" src="public/images/<?= $iconUrl ?>"/></span></span>
				<?php if($allowEdit) {?>
				<span class="td"><button name="resend" class="icon-wrapper"><img class="icon" src="public/images/email-reply-32.png" title="Resend registration email"/></button></span>
				<span class="td"><button name="delete" class="icon-wrapper"><img class="icon" src="public/images/error-glossy-24.png" title="Unregister voter"/></button></span>
				<?php } ?>
			</form>
		
	<?php } ?>
	</tbody>
</table>
<?php 
	}
?>

</div>
<?php 
	if($allowEdit){
?>
<div id="content-right">

<form method="post">
	<h3>Add Voters</h3>
	<p>
Enter the email addresses of the  voters below.<br>
Each voter will be assigned a unique Voter ID and a Password.
You can optional set the string that will prefix each Voter ID.
</p>
	<div class="form-row">
		<label>Prefix</label>
		<?php 
			$prefix = $data->election->getPrefix();
		?>
		<input type="text" name="prefix" value="<?= $prefix ?>" <?= $prefix? "disabled" : ""?>/>
	</div>
	<div class="form-row">
		<label>Voters' Emails</label>
		<textarea name="emails" style="height:300px"></textarea>
	</div>
	<div class="buttons">
		<button name="add">Add Voters</button>
	</div>
	<p><?= $data->formResult ?></p>

</form>
<p><?= $data->formResult ?></p>
</div>
<?php 
	}
?>

