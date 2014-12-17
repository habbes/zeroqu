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
	</body>
</html>