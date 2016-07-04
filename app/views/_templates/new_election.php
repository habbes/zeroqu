<div class="col-md-8">
<p>
You will be able to edit more details once the election has been created.
</p>
<form method="post" class="form" role="form">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" style="width:450px" id="title-field" placeholder="" required class="form-control"/>
	</div>
	<div class="form-group">
		<label for="attributes">Custom Attributes</label>
		<div class="entry input-group col-xs-8"  style="margin-bottom: 10px">
			<input type="text" class="form-control" name="attribute_types[]" id="type" placeholder="Attribute type"/>
			<span class="input-group-addon"></span>
			<input type="text" class="form-control" name="attributes_names[]" placeholder="Attribute name"/>
			<span class="input-group-btn">
				<button class="btn btn-success btn-add" type="button">
					<span class="glyphicon glyphicon-plus"></span>
				</button>
			</span>
		</div>
		
	</div>
	<div class="form-group id">
		<label for="id">Election ID</label><br>
		<div class="input-group col-xs-8">
			<span class="input-group-addon" id="basic-addon3"><?= URL_ROOT?></span>
			<input type="text" name="id" class="form-control" id="id-field" aria-describedby="basic-addon3">
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

	$(function()
		{
			$(document).on('click', '.btn-add', function(e)
			{
				e.preventDefault();
	
				var controlForm = $('.form:first');
					currentEntry = $(this).parents('.entry:first');
					newEntry = $(currentEntry.clone()).insertBefore(".id");

				newEntry.find('input').val('');
				controlForm.find('.entry:not(:last) .btn-add')
					.removeClass('btn-add').addClass('btn-remove')
					.removeClass('btn-success').addClass('btn-danger')
					.html('<span class="glyphicon glyphicon-minus"></span>');
			}).on('click', '.btn-remove', function(e)
			{
				$(this).parents('.entry:first').remove();

				e.preventDefault();
				return false;
			});
		});

</script>
