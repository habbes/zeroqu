<?php 
	if($data->message){
?>
	<p><?= $data->message ?>
<?php 
	}
	if($data->election->hasEnded()){
?>
	<p>
		The voting process has ended, open the Results menu to view the results.
	</p>
<?php 
	}
	else {
		?>
		
	<p>
		Open the Settings menu to change the Title, Start and End Dates of the Election and more.
	</p>
	<p>
		Open the Positions menu to add positions that will be contested for.
	</p>
	<p>
		Open the Candidates menu to add candidates for the different positions.
	</p>
	<p>
		Open the Voters menu to add and invite voters.
	</p>
	<p>
		Open the Results menu to view the results of the election process.
	</p>
		<?php 
	}
		
?>