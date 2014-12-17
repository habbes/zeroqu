
<div id="content-center">

<?php 
	$positions = $data->get("positions",[]);
	$allowEdit = $data->election->isPending();
	foreach($positions as $position)
	{
?>
	<div class="position-wrapper" data-id="<?= $position->getId()?>">
		<h3 class="title"><?= $position->getTitle() ?></h3>
		<p>This position has <b><?= $position->countCandidates() ?> candidates.</b></p>
		<p class="description" data-empty="<?= $position->getDescription()? "false" : "true"?>">
			<?= $position->getDescription()? $position->getDescription() : "<i>No description available.</i>"?>
		</p>
		<?php 
			if($allowEdit){
		?>
		<div>
			<button class="btnEdit">Edit</button>
			<button class="btnDelete">Delete</button>
		</div>
		<?php 
			}
		?>
		
	</div>
<?php 
	}
	
	if(count($positions) == 0){
		?>
	<p>No positions found. Use the form on the right to create a new position.</p>	
		<?php 
	}

?>

</div>
<div id="content-right">

<?php 
	if($allowEdit) {
?>

<h3 id="form-title">Create Position</h3>
<form id="position-form" method="post">
	<input type="hidden" name="action" value="create"/>
	<input type="hidden" name="position" value="" />
	<div class="form-row">
		<label>Title</label>
		<input type="text" name="title" value=""/>
	</div>
	<div class="form-row">
		<label>Description</label>
		<textarea name="description"></textarea>
	</div>
	<div class="form-buttons">
		<button name="actionBtn" >Save New Position</button>
		<button name="newBtn" style="display:none">Create New</button>
	</div>
	<p><?= $data->formResult ?></p>
</form>

</div>

<script>
	var posWrappers = document.getElementById("content-center").getElementsByClassName("position-wrapper");
	var wrapper, position, btnEdit, btnDelete;
	var form = document.forms['position-form'];
	var formTitle = document.getElementById("form-title");
	var actionBtn = document.getElementById("form-action-btn");
	var newBtn = document.getElementById("form-new-btn");
	for(var i = 0; i < posWrappers.length; i++){
		wrapper = posWrappers[i];
		position = new Object();
		position.id = wrapper.getAttribute('data-id');
		position.title = wrapper.getElementsByClassName("title")[0].textContent.trim();
		var descrNode = wrapper.getElementsByClassName("description")[0]
		position.description = descrNode.getAttribute("data-empty") == "false"? descrNode.textContent.trim() : "";

		btnEdit = wrapper.getElementsByClassName("btnEdit")[0];
		btnEdit.position = position;
		btnEdit.onclick = function(){
			form.action.value = "edit";
			form.position.value = this.position.id;
			form.title.value = this.position.title;
			form.description.value = this.position.description;
			form.actionBtn.textContent = "Save Changes";
			form.newBtn.style.display = "inline-block";
			formTitle.textContent = "Edit Position";
		}

		btnDelete = wrapper.getElementsByClassName("btnDelete")[0];
		btnDelete.position = position;
		btnDelete.onclick = function(){
			if(!confirm("Deleting this position will also remove all candidates running for the position."
					+ "\nAre you sure you want to delete?")){
				return
			}
			form.action.value = "delete";
			form.position.value = this.position.id;
			form.submit();
		}
		
	}
	form.newBtn.onclick = function() {
		form.action.value = "create";
		form.position.value = "";
		form.title.value = "";
		form.description.value = "";
		form.actionBtn.textContent = "Save New Position";
		form.newBtn.style.display = "none";
		formTitle.textContent = "Create Position";
		return false;
	}
		
</script>

<?php 
	} 
?>