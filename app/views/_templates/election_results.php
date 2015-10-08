<?php
if(!$data->election->hasEnded()){
?>
<p>Election has not yet ended. The votes will be tallied once the voting process has ended.</p>
<?php 
}
?>
<div>

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
	<div class="position-wrapper clear-both" data-id="<?= $position->getId()?>">
		<h3 class="title"><?= $position->getTitle() ?></h3>
		<div style="margin-bottom:10px">
			<b>Total Votes: <strong style="font-size:1.2em;display:inline-block;margin-left:5px"><?= $total ?></strong></b>
		</div>
		<div class="candidates-wrapper">
		<?php 
			foreach($candidates as $candidate) {
				$numVotes = $candidate->countVotes();
				$imagePath = $candidate->getImagePath()? $candidate->getImagePath() : 'public/images/generic-user-96.png';
		?>
			<div class="candidate-wrapper-small" data-pos="<?= $position->getId()?>" data-id="<?= $candidate->getId()?>">
				<div class="candidate-name bold" style="font-size:1.2em"><?= $candidate->getName()?></div>
				<div class="candidate-img-wrapper">
					<img alt="Candidate's picture" class="candidate-img-small" src="<?= $imagePath ?>" style="height:130px"/>
					<span class="vote-count">
						<?= $numVotes ?>
					</span>
					<span class="vote-count">
						<?php printf("%.2f%%", $total > 0? $numVotes * 100/$total : 0); ?>
				</span>
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