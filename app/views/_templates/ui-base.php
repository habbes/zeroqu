<!doctype html>
<html lang="en">
<head>
	<title>zeroQu Election Manager</title>
	<base href="<?= URL_ROOT ?>">
	<link href="public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/css/style.css" rel="stylesheet">
	<?php 
		foreach($data->get('styles', []) as $style)
		{
		?>
	<link href="public/css/<?= $style ?>" rel="stylesheet">
		<?php 
		}
	?>
	<?php 
		foreach($data->get('inlineStyles',[]) as $iStyle)
		{
			?>
	<style>
		<?= $iStyle ?>
	</style>
			<?php
		}
	?>
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
	        	<span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		    </button>
	      	<a class="navbar-brand logo" href="#">zero<span class="logo-q">Q</span>u</a>
		</div>

		<div class="collapse navbar-collapse">
			<?= $data->navbar ?>
		</div>
	</div>
</nav>

<div id="page-body">
	<?= $data->pageBody ?>
</div>



<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<?php 
foreach($data->get('scripts',[]) as $script){
	?>
<script src="<?= $script ?>"></script>
}

?>

foreach($data->get('inlineScripts',[]) as $iScript){
	?>
<script>
<?= $iScript ?>
</script>
}

?>

<script>
$('#formtabs a').click(function(e){
	e.preventDefault();
	$(this).tab('show');
})
</script>

</body>

</html>