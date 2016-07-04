<?php 
if($data->formResult){
	?>
	<p class="form-result"><?= $data->formResult ?></p>
	<?php 
}
?>
<div class="col-md-8">
<form method="post" style="margin-top:20px" >
	<div class="col-md-12">
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
	<div class="col-md-12" style="padding-top: 20px">
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
	<hr>
	<div class="col-md-12">
		<small>These custom values are used to filter voters in an election</small>
		<table class="table table-bordered">
			<thead>
				<tr><th>Attribute type</th><th>Attribute name</th> </tr>
			</thead>
			<tbody>
			<?php foreach($data->election->getCustomProperties() as $attribute){ ?>
				<tr><td style="color: #aaa"><?=$attribute->type?></td><td><?=$attribute->name?></td> </tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	</div>
</form>
</div>
<div class="col-md-4">
<form method="post" class="form" role="form">
	<div class="form-group">
		<label for="attributes">Custom Attributes</label>
		<div class="entry input-group col-xs-12"  style="margin-bottom: 10px">
			<input type="text" class="form-control" name="attribute_types[]" id="type" placeholder="Attribute type"/>
			<span class="input-group-addon"></span>
			<input type="text" class="form-control" name="attribute_names[]" placeholder="Attribute name"/>
			<span class="input-group-btn">
				<button class="btn btn-success btn-add" type="button">
					<span class="glyphicon glyphicon-plus"></span>
				</button>
			</span>
		</div>
		
	</div>
	<div class="form-group id">
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
<script>
	$(function()
		{
			$(document).on('click', '.btn-add', function(e)
			{
				e.preventDefault();
	
				var controlForm = $('.form:first');
					currentEntry = $(this).parents('.entry:first');
					newEntry = $(currentEntry.clone()).insertBefore(".id");

				newEntry.find('input').val('');
				controlForm.find('.entry:not(:last) .btn-add')
					.removeClass('btn-add').addClass('btn-remove')
					.removeClass('btn-success').addClass('btn-danger')
					.html('<span class="glyphicon glyphicon-minus"></span>');
			}).on('click', '.btn-remove', function(e)
			{
				$(this).parents('.entry:first').remove();

				e.preventDefault();
				return false;
			});
		});

</script>
</div>
