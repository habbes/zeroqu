<div class="col-md-8">
<p>
You will be able to edit more details once the election has been created.
</p>
<form method="post" class="form">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" style="width:450px" id="title-field" placeholder="" required class="form-control"/>
	</div>
	<div class="form-group">
		<label for="id">Election ID</label><br>
		<div class="col-md-2">
			<span style="display:inline-block;width:150px; padding-top: 9px"><?= URL_ROOT?>/</span>
		</div>
		<div class="col-md-10">
			<input type="text" name="id" id="id-field" placeholder="" class="form-control" style="width: 60%"/>
		</div>
	</div>
	<div class="form-group">
		<button class="btn btn-success" style="margin-top: 15px;">Create</button>
	</div>
	
</form>
</div>
<script>
	var titleField = document.getElementById("title-field");
	var idField = document.getElementById("id-field");

	titleField.onkeyup = function(){
		idField.value = titleField.value.toLowerCase().replace(/\s+/g,"-");
	}
</script>
