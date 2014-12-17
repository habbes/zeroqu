<p>

<?php 

	if(count($data->elections) == 0){
		?>
	There are no elections in your account. Use the menu on the left to create a new election.
		<?php 
	}
	else {
		?>
	To manage an election, use the menu on the left.
		<?php
	}
?>

</p>