<p>
You did not vote in this position.
</p>
<?php 
if($data->position->getDescription()){
	?>
<p>
<?= $data->position->getDescription() ?>
</p>
	<?php
}
?>