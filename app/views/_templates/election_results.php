
<?php

if(!$data->election->hasEnded()){
?>
<div class="container-fluid">
<div class="col-xs-6">Election is still ongoing. The votes will be tallied once the voting process has ended.</div>

</div>
<?php 
}
?>
<div>
<div class="container-fluid">
<div class="col-md-12"><a href="<?=$data->electionUrl?>/results/details" class="pull-right">More details...</a></div>
</div>
<?php 
	$positions = $data->get("positions",[]);
	$allowEdit = $data->election->isPending();
	function callback($a, $b){
		return $b->countVotes() - $a->countVotes();
	}
	foreach($positions as $position)
	{
		
		$candidates = $position->getCandidates();
		$total = $position->countVotes();
		
		uasort($candidates, 'callback');
?>
	<div class="panel panel-default clear-both" data-id="<?= $position->getId()?>">
		<div class="panel-heading">
			<h3 class="panel-title"><?= $position->getTitle() ?></h3>
		</div>
		<div style="margin-bottom:10px; padding-left: 20px">
			<b>Total Votes: <strong style="font-size:1.2em;display:inline-block;margin-left:5px"><?= $total ?></strong></b>
		</div>

		<div class="container-fluid">
		<?php 
			foreach($candidates as $candidate) {
				$numVotes = $candidate->countVotes();
				$imagePath = $candidate->getImagePath()? $candidate->getImagePath() : 'public/images/generic-user-96.png';
		?>
			<div class="panel panel-default" data-pos="<?= $position->getId()?>" data-id="<?= $candidate->getId()?>">
				<div class="panel-header" style="font-size:1.2em">
					<h6 class="panel-title" style="padding-left: 20px"><?= $candidate->getName()?></h6>
				
				</div>
				<div class="panel-body">
					<div class="col-md-4">
						<img alt="Candidate's picture" class="candidate-img-small" width="250" src="<?= $imagePath ?>" style="height:130px"/>
					</div>
					<div class="col-md-4" style="height:100%;border-right: solid #ccc 1px; font-size: 2em; text-align:center">
						<?= $numVotes ?>
					</div>
					<div class="col-md-4" style="border-left: solid #ccc 1px; font-size: 2em; text-align:center">
						<?php printf("%.2f%%", $total > 0? $numVotes * 100/$total : 0); ?>
					</div>
				</div>
				
			</div>
		
		<?php
			}
		?>
		</div>
		
	</div>
<?php 
	}
	

?>


</div>