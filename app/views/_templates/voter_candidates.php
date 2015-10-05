<div class="col-md-8">
<?php
$positions = $data->positions;

foreach($positions as $position){
	
	$candidates = $position->getCandidates();
	?>
		<div class="col-md-12" data-id="<?= $position->getId()?>">
			<h3 class="title"><?= $position->getTitle() ?></h3>
			<div class="candidates-wrapper">
			<?php 
				foreach($candidates as $candidate) {
			?>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading"><?= $candidate->getName()?></div>
					<div class="pannel-body">
						<img alt="Candidate's picture" class="img-responsive" src="public/images/generic-user-96.png"/>
					</div>
				</div>
			</div>
			<?php
				}
				if(count($candidates) == 0){
			?>
			<p>No candidates found for this position.</p>
			<?php	
				}
			?>
			</div>
			
		</div>
<?php 
}
		
if(count($positions) == 0){
?>
<p>No candidates found.</p>	
<?php 
}


?>
</div>