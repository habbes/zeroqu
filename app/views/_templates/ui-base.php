<!doctype html>
<html lang="en">
<head>
	<title>zeroQu Election Manager</title>
	<base href="<?= URL_ROOT ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="public/bower_components/magnific-popup/dist/magnific-popup.css">
	<link href="public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/css/style.css" rel="stylesheet">
	<style rel="stylesheet">
		.white-popup {
			position: relative;
			background: #FFF;
			padding: 20px;
			width: auto;
			max-width: 500px;
			margin: 20px auto;
			}
	</style>
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

<header class="main-header">
<nav class="navbar navbar-container">
	<div class="container">
		<?= $data->navbar ?>
	</div>
</nav>
</header>
<div id="page-body">
	<?= $data->pageBody ?>
</div>

<footer class="main-footer">
	
	<div class="container">
		&copy; 2015 - <span class="logo">zero<span class="logo-q-dark">q</span>u</span>. All rights reserved.
	</div>
	
</footer>


<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="public/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<?php foreach($data->get('scripts',[]) as $script){ ?>
<script src="<?= $script ?>"></script>
<?php } ?>

<?php foreach($data->get('inlineScripts',[]) as $iScript){ ?>
<script>
<?= $iScript ?>
</script>
<?php } ?>

<script>
$('#formtabs a').click(function(e){
	e.preventDefault();
	$(this).tab('show');
});
$('.popup-image').magnificPopup({
  type: 'image'
  // other options
});
</script>

</body>

</html>