<?php 

$url = $data->election->getName();

?>

<ul class="menu-list">
	<li>
		<a href="<?= $url ?>/view-candidates">Candidates</a>
	</li>
		<?php
			if($data->election->isOngoing()){
		?>
	<li>
		<a>Vote</a>
		<ul class="submenu">
			<?php 
				foreach($data->election->getPositions() as $position){
			?>
				<li><a href="<?= $url ?>/vote/<?= urlencode($position->getTitle())?>"><?= $position->getTitle()?></a></li>
			<?php
				}
			?>
		</ul>
		
		<?php
		}		
		?>
	</li>
	<li>
		<?php 
			if($data->election->hasEnded()){
		?>
			<a href="<?= $url ?>/results">Results</a>
		<?php
			}
		?>
	</li>
</ul>
