<p>
You will be able to edit more details once the election has been created.
</p>
<form method="post">
	<div class="form-row">
		<label for="title">Title</label>
		<input type="text" name="title" style="width:450px" id="title-field" placeholder="" />
	</div>
	<div class="form-row">
		<label for="id">Election ID</label>
		<span style="display:inline-block;width:150px"><?= URL_ROOT?>/</span><input type="text" name="id" id="id-field" placeholder=""/>
	</div>
	<div class="buttons">
		<button>Create</button>
	</div>
	
</form>
<script>
	var titleField = document.getElementById("title-field");
	var idField = document.getElementById("id-field");

	titleField.onkeyup = function(){
		idField.value = titleField.value.toLowerCase().replace(/\s+/g,"-");
	}
</script>
