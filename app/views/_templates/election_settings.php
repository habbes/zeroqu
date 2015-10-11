<?php 
if($data->formResult){
	?>
	<p class="form-result"><?= $data->formResult ?></p>
	<?php 
}
?>
<div class="col-md-8">
<form method="post" style="margin-top:20px" >
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
			$btnType = $data->election->isPending()? "btn-success" : "btn-danger";
			?>
		<div class="buttons">
			<button name="change-status" class="btn btn-success"><?= $action ?></button>
		</div>
			<?php 
		}
		else {
			if(!$data->election->areResultsReleased()){
			?>
			<button name="release-results" class="btn btn-success">Allow Voters To View Results</button>
			<?php
			}
			else {
			?>
			<b>Voters can also view the results</b>
			<?php
			}
		}
	?>
	
</form>
</div>
<div class="col-md-4">
<form method="post" class="form">
	<div class="form-group">
		<label>Election ID</label>
		<input type="text" class="form-control" value="<?= $data->election->getName()?>" disabled />
	</div>
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" class="form-control" value="<?= $data->election->getTitle()?>" <?php if($data->election->hasEnded()){echo "disabled";}?>/>
	</div>
	<div class="form-group">
		<label for="start-date">Start Date</label>
		<?php
			$startDate = $data->election->getStartDate()? Utils::dbDateFormat($data->election->getStartDate()) : "";
		?>
		<input type="text" name="start-date" class="form-control" value="<?= $startDate ?>" 
		<?php if($data->election->hasEnded() || $data->election->isOngoing()){echo "disabled";}?>/>
	</div>
	<div class="form-group">
		<label for="end-date">End Date</label>
		<?php
			$endDate = $data->election->getEndDate()? Utils::dbDateFormat($data->election->getEndDate()) : "";
		?>
		<input type="text" name="end-date" class="form-control" value="<?= $endDate ?>" <?php if($data->election->hasEnded()){echo "disabled";}?>/>
	</div>
	<?php if(!$data->election->hasEnded()){ ?>
	<div class="form-group">
		<button name="details" class="btn btn-primary form-control">Save</button>
	</div>
	
	<?php }?>
</form>
</div>
