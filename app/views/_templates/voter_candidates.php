<?php
$positions = $data->positions;

foreach($positions as $position){
	
	$candidates = $position->getCandidates();
	?>
		<div class="position-wrapper clear-both" data-id="<?= $position->getId()?>">
			<h3 class="title"><?= $position->getTitle() ?></h3>
			<div class="candidates-wrapper">
			<?php 
				foreach($candidates as $candidate) {
			?>
				<div class="candidate-wrapper-large panel panel-default float-left">
					<div class="candidate-name panel-heading"><?= $candidate->getName()?></div>
					<div class="candidate-img-wrapper pannel-body">
						<img alt="Candidate's picture" class="candidate-img-large" src="public/images/generic-user-96.png"/>
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