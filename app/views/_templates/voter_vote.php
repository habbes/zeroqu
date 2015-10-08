
<?php 
if($data->position->getDescription()){
	?>
<p>
<?= $data->position->getDescription() ?>
</p>
	<?php
}

?>

<form method="post" id="voteForm">
	<?php 
		foreach($data->candidates as $candidate){
			$name = $candidate->getName();
			$id = $candidate->getId();
			$imagePath = $candidate->getImagePath()? $candidate->getImagePath() : "public/images/generic-user-96.png";
	?>
		<div class="form-row candidate-wrapper-large float-left center-text">
			<div class="center-text"><span class="candidate-name bold center-text"><?= $name ?></span></div>
			<div>
				<img src="<?= $imagePath ?>" class="candidate-img-large"/>
			</div>
			<div>
			<input type="radio" id="candidate<?= $id ?>" name="candidate" value="<?= $id ?>" data-name="<?= $name ?>"/>
			</div>
		</div>
	
	<?php 		
		}
	?>
	
	<div class="form-group">
		<button class="btn btn-success">Cast Vote</button>
	</div>
	<p><?= $data->formResult ?></p>
</form>
<script>

var form = document.forms.voteForm;

form.onsubmit = function(){

	var id = this.candidate.value;
	if(!id){
		alert("Please select candidate.");
		return false;
	}

	var candidate = document.getElementById("candidate"+id);
	return confirm("Are you sure you want to vote for " + candidate.getAttribute("data-name") + "?");
}

</script>