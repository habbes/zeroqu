
<div id="content-center" class="col-md-8">

<?php 
	$positions = $data->get("positions",[]);
	$allowEdit = $data->election->isPending();
	foreach($positions as $position)
	{
		$candidates = $position->getCandidates();
?>
	<div class="position-wrapper clear-both" data-id="<?= $position->getId()?>">
		<h3 class="title"><?= $position->getTitle() ?></h3>
		<div class="candidates-wrapper row">
		<?php 
			foreach($candidates as $candidate) {
		?>
		<div class="col-md-4">
			<div class="candidate-wrapper panel panel-default" data-pos="<?= $position->getId()?>" data-id="<?= $candidate->getId()?>">
				<div class="candidate-name panel-heading"><?= $candidate->getName()?></div>
				<div class="panel-body">
					<img alt="Candidate's picture" class="img img-responsive col-md-12 col-xs-12" src="public/images/generic-user-96.png"/>
				</div>
				<?php 
					if($allowEdit){
				?>
				<div class="panel-footer">
					<div class="row">
						<div class="btn-group col-md-offset-3 col-md-9 col-xs-offset-3 col-xs-9" role="group" aria-label="...">
						  <button type="button" class="btnEdit btn btn-default"><i class="fa fa-pencil-square-o"></i></button>
						  <button type="button" class="btnDelete btn btn-danger"><i class="fa fa-trash-o"></i></button>
						</div>
					</div>
				</div>
				<?php 
					}
				?>
			</div>
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
<div id="content-right" class="col-md-4">

<?php 
	if($allowEdit) {
?>

<h3 id="form-title">Add Candidate</h3>
<form id="candidate-form" method="post" enctype="multipart/form-data" class="form">
	<input type="hidden" name="action" value="create"/>
	<input type="hidden" name="candidate" value="" />
	<div class="form-group">
		<label>Position</label>
		<select name="position" class="form-control">
		<?php foreach($positions as $position) {?>
			<option value="<?= $position->getId()?>"><?= $position->getTitle() ?></option>
		<?php }?>
		</select>
	</div>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" value="" class="form-control"/>
	</div>
	<div class="form-group">
		<label>Picture</label>
		<input type="file" name="picture"/>
	</div>
	<div class="form-group">
		<button name="actionBtn" class="btn btn-success">Add Candidate</button>
		<button name="newBtn" style="display:none" class="btn btn-default">Add New</button>
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