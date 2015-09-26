<!doctype html>
<html>
	<head>
		<?php
			$sub = $data->get('subtitle','');
			$sub = $sub? $sub." | " : "";
		?>
		<title><?= $sub?>Elections Manager</title>
		<base href="<?= URL_ROOT."/"?>">
		<link href="public/css/basic.css" rel="stylesheet" >
		<!-- Bootstrap Core CSS -->
    	<link href="public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    	<!-- MetisMenu CSS -->
    	<link href="public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    	<!-- Timeline CSS -->
    	<link href="public/dist/css/timeline.css" rel="stylesheet">

    	<!-- Custom CSS -->
    	<link href="public/dist/css/sb-admin-2.css" rel="stylesheet">

    	<!-- Morris Charts CSS -->
    	<link href="public/bower_components/morrisjs/morris.css" rel="stylesheet">

    	<!-- Custom Fonts -->
    	<link href="public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  
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
		<?= $data->body; ?>
		
		<!-- jQuery -->
    	<script src="public/bower_components/jquery/dist/jquery.min.js"></script>

    	<!-- Bootstrap Core JavaScript -->
    	<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    	<!-- Metis Menu Plugin JavaScript -->
    	<script src="public/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    	<!-- Morris Charts JavaScript 
    	<script src="public/bower_components/raphael/raphael-min.js"></script>
    	<script src="public/bower_components/morrisjs/morris.min.js"></script>
    	<script src="public/js/morris-data.js"></script>
		-->
    	<!-- Custom Theme JavaScript -->
    	<script src="public/dist/js/sb-admin-2.js"></script>
		</body>
</html>