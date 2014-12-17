<?php 
if($data->formResult){
	?>
	<p class="form-result"><?= $data->formResult ?></p>
	<?php 
}
?>
<form method="post">
	<div class="form-row">
		<label>Election ID</label>
		<input type="text" value="<?= $data->election->getName()?>" disabled />
	</div>
	<div class="form-row">
		<label for="title">Title</label>
		<input type="text" name="title" value="<?= $data->election->getTitle()?>" <?php if($data->election->hasEnded()){echo "disabled";}?>/>
	</div>
	<div class="form-row">
		<label for="start-date">Start Date</label>
		<?php
			$startDate = $data->election->getStartDate()? Utils::dbDateFormat($data->election->getStartDate()) : "";
		?>
		<input type="text" name="start-date" value="<?= $startDate ?>" 
		<?php if($data->election->hasEnded() || $data->election->isOngoing()){echo "disabled";}?>/>
	</div>
	<div class="form-row">
		<label for="end-date">End Date</label>
		<?php
			$endDate = $data->election->getEndDate()? Utils::dbDateFormat($data->election->getEndDate()) : "";
		?>
		<input type="text" name="end-date" value="<?= $endDate ?>" <?php if($data->election->hasEnded()){echo "disabled";}?>/>
	</div>
	<?php if(!$data->election->hasEnded()){ ?>
	<div class="buttons">
		<button name="details">Save</button>
	</div>
	
	<?php }?>
</form>

<form method="post" style="margin-top:20px">
	<div class="form-row">
		<?php 
			switch($data->election->getStatus()){
				case Election::PENDING:
					$status = "Election has not yet begun";
					break;
				case Election::ONGOING:
					$status = "Election is in progress";
					break;
				case Election::ENDED:
					$status = "Election has ended";
					break;
			}
		?>
		<span>Current Status: </span><span style="font-weight:bold"><?= $status ?></span>
		
	</div>
	<?php 
		if(!$data->election->hasEnded()){
			$action = $data->election->isPending()?"Start Election Now" : "End Election Now";
			?>
		<div class="buttons">
			<button name="change-status"><?= $action ?></button>
		</div>
			<?php 
		}
	?>
	
</form>