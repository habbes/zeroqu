
<div id="content-center" class="col-md-8">

<?php 
	$positions = $data->get("positions",[]);
	$allowEdit = $data->election->isPending();
	foreach($positions as $position)
	{
?>
	<div class="position-wrapper panel panel-default" data-id="<?= $position->getId()?>">
		<div class="panel-heading title"><h3 class="panel-title"><?= $position->getTitle() ?></h3></div>
		<div class="panel-body">
			<p>This position has <b><?= $position->countCandidates() ?> candidates.</b></p>
			<p class="description" data-empty="<?= $position->getDescription()? "false" : "true"?>">
				<?= $position->getDescription()? $position->getDescription() : "<i>No description available.</i>"?>
			</p>
			<?php 
				if($allowEdit){
			?>
			<div>
				<button class="btnEdit btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</button>
				<button class="btnDelete btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
			</div>
			<h3>Position Rules</h3>
			<p><i>These rules limit which voters can cast a vote in this position</i></p>
			<form method="post">
				<h4>Add Rule</h4>
				<div class="form-group">
					<label>Rule Description</label>
					<input type="text" name="name" class="form-control"
						placeholder="Enter a name or short description for the rule">
				</div>
				<div class="form-group">
					<label>Property to use to restrict voters</label>
					<select name="property" class="form-control" required>
						<?php foreach($data->election->getCustomProperties() as $property){?>
						<option value="<?= $property->getId() ?>"><?= $property->getName() ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Value for authorized voters</label>
					<input type="text" name="value" class="form-control" 
						placeholder="Value that authorized voters must have for the selected property" required>
				</div>
				<div class="form-group">
					<button class="btn btn-default"><i class="fa fa-plus"></i> Add Rule</button>
				</div>
				
			</form>
			<?php 
				}
			?>
		</div>
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
<div id="content-right" class="col-md-4">

<?php 
	if($allowEdit) {
?>

<h3 id="form-title">Create Position</h3>
<form id="position-form" method="post" class="form">
	<input type="hidden" name="action" value="create"/>
	<input type="hidden" name="position" value="" />
	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" value="" class="form-control"/>
	</div>
	<div class="form-group">
		<label>Description</label>
		<textarea name="description" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<button name="actionBtn" class="btn btn-success">Save New Position</button>
		<button name="newBtn" style="display:none" class="btn btn-default">Create New</button>
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