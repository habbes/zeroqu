
<div id="content-center">

<?php 
	$positions = $data->get("positions",[]);
	$allowEdit = $data->election->isPending();
	foreach($positions as $position)
	{
		$candidates = $position->getCandidates();
?>
	<div class="position-wrapper clear-both" data-id="<?= $position->getId()?>">
		<h3 class="title"><?= $position->getTitle() ?></h3>
		<div class="candidates-wrapper">
		<?php 
			foreach($candidates as $candidate) {
		?>
			<div class="candidate-wrapper float-left" data-pos="<?= $position->getId()?>" data-id="<?= $candidate->getId()?>">
				<div class="candidate-name bold"><?= $candidate->getName()?></div>
				<div class="candidate-img-wrapper">
					<img alt="Candidate's picture" class="candidate-img" src="public/images/generic-user-96.png"/>
				</div>
				<?php 
					if($allowEdit){
				?>
				<div>
					<button class="btnEdit">Edit</button>
					<button class="btnDelete">Remove</button>
				</div>
				<?php 
					}
				?>
			</div>
		
		<?php
			}
			if(count($candidates) == 0){
		?>
		<p>No candidates found for this position. Use the form on the right to add candidates.</p>
		<?php	
			}
		?>
		</div>
		
	</div>
<?php 
	}
	
	if(count($positions) == 0){
		?>
	<p>You must first create positions before you can add candidates.</p>	
		<?php 
		return false;
	}

?>

</div>
<div id="content-right">

<?php 
	if($allowEdit) {
?>

<h3 id="form-title">Add Candidate</h3>
<form id="candidate-form" method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="create"/>
	<input type="hidden" name="candidate" value="" />
	<div class="form-row">
		<label>Position</label>
		<select name="position">
		<?php foreach($positions as $position) {?>
			<option value="<?= $position->getId()?>"><?= $position->getTitle() ?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-row">
		<label>Name</label>
		<input type="text" name="name" value=""/>
	</div>
	<div class="form-row">
		<label>Picture</label>
		<input type="file" name="picture"/>
	</div>
	<div class="form-buttons">
		<button name="actionBtn" >Add Candidate</button>
		<button name="newBtn" style="display:none">Add New</button>
	</div>
	<p><?= $data->formResult ?></p>
</form>

</div>

<script>
	var candWrappers = document.getElementById("content-center").getElementsByClassName("candidate-wrapper");
	var wrapper, position, btnEdit, btnDelete;
	var form = document.forms['candidate-form'];
	var formTitle = document.getElementById("form-title");
	var actionBtn = document.getElementById("form-action-btn");
	var newBtn = document.getElementById("form-new-btn");
	for(var i = 0; i < candWrappers.length; i++){
		wrapper = candWrappers[i];
		candidate = new Object();
		candidate.id = wrapper.getAttribute('data-id');
		candidate.position = wrapper.getAttribute('data-pos');
		candidate.name = wrapper.getElementsByClassName("candidate-name")[0].textContent.trim();
		

		btnEdit = wrapper.getElementsByClassName("btnEdit")[0];
		btnEdit.candidate = candidate;
		btnEdit.onclick = function(){
			form.action.value = "edit";
			form.candidate.value = this.candidate.id;
			form.position.value = this.candidate.position;
			form.name.value = this.candidate.name;
			form.actionBtn.textContent = "Save Changes";
			form.newBtn.style.display = "inline-block";
			formTitle.textContent = "Edit Candidate";
		}

		btnDelete = wrapper.getElementsByClassName("btnDelete")[0];
		btnDelete.candidate = candidate;
		btnDelete.onclick = function(){
			if(!confirm("Are you sure you want to remove " + this.candidate.name + " as a candidate?")){
				return
			}
			form.action.value = "delete";
			form.candidate.value = this.candidate.id;
			form.submit();
		}
		
	}
	form.newBtn.onclick = function() {
		form.action.value = "create";
		form.candidate.value = "";
		form.name.value = "";
		form.position.selectedIndex = 0;
		form.actionBtn.textContent = "Add Candidate";
		form.newBtn.style.display = "none";
		formTitle.textContent = "New Candidate";
		return false;
	}
		
</script>

<?php 
	} 
?>