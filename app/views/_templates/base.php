<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
		<?php
			$sub = $data->get('subtitle','');
			$sub = $sub? $sub." | " : "";
		?>
		<title><?= $sub?>zeroQu</title>
		<base href="<?= URL_ROOT."/"?>">
		
		<!-- Bootstrap Core CSS -->
    	<link href="public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    	<!-- MetisMenu CSS -->
    	<link href="public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    	<!-- Timeline CSS -->
    	<link href="public/dist/css/timeline.css" rel="stylesheet">

    	<!-- Custom CSS -->
    	<link href="public/dist/css/sb-admin-2.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
    	<!-- Morris Charts CSS -->
    	<link href="public/bower_components/morrisjs/morris.css" rel="stylesheet">

    	<!-- Custom Fonts -->
    	<link href="public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="public/css/basic.css" rel="stylesheet" >
  
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
		<!-- HighCharts -->
		
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
    	<script>
		$(document).ready(function(){
		    $('[data-toggle="popover"]').popover();   
		});
	</script>
		</body>
</html>