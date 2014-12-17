
<span class="menu-header"><a href="new-election"><span class="new-icon">+</span> New Election</a></span>
<ul class="menu-list">
	<?php 
		foreach($data->elections as $election){
			$url = $election->getName();
		?>
		<li>
			<a class="election-link" href="<?=$url?>"><?= $election->getTitle() ?></a>
			<?php if($data->election && $election->is($data->election)) {?>
			<ul class="submenu">
				<li><a href="<?=$url?>/settings">Settings</a></li>
				<li><a href="<?=$url?>/positions">Positions</a></li>
				<li><a href="<?=$url?>/candidates">Candidates</a></li>
				<li><a href="<?=$url?>/voters">Voters</a></li>
				<li><a href="<?=$url?>/results">Results</a>
			</ul>
			<?php }?>
		</li>
		<?php 
	}?>
</ul>
