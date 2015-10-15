
<?php $date = date("d M Y",$data->election->getStartDate()); ?>
<style>
h4, h5{
	font-family: Arial !important;
}
</style>
<div class="col-md-12" style="font-family: Arial !important; ">
	<div class="col-md-8 col-md-offset-2" style="font-size: 0.9em">
		<div class="col-md-12">
			<h4>Organization: <?=$data->election->getOrg()->getTitle()?></h4>
			<h5>Election: <?=$data->election->getTitle()?></h5>
			<?php if($data->election->getStartDate()){ ?>
				<span class="pull-right" style="text-align: center; font-size: 0.9em"><strong>Elections held on</strong> <?=$date ?></span>
			<?php }else{ ?>
				<span class="pull-right" style="text-align: center; font-size: 0.9em">Elections have not started</span>
				<?php } ?>
		</div>
		<br><br><br><br><br>
		<div class="col-md-12">
			<?php foreach($data->results['positions'] as $result){ ?>
			
			<h4><?=$result['title']?></h4>
				<table class="table table-bordered">
				<thead>
					<tr><th>Name</th><th>Votes</th><th>Percentage votes</th><th>Signature</th></tr>
				</thead>
				<?php foreach ($result['candidates'] as $candidate){?>
					<tbody>
						<tr><td><?=$candidate['name']?></td><td><?=$candidate['votes']?></td><td><?php printf("%.2f%%", $result['votes'] > 0? $candidate['votes'] * 100/$result['votes'] : 0); ?></td><td></tr>
					</tbody>
				<?php } ?>
				</table>
			<?php }?>	
			<span class="pull-left" style="text-align: center; font-size: 0.9em"><strong>Printed by</strong> <?=$data->user->getUsername()?> <strong>on</strong> <?=date('d M Y',time())?> <strong>at</strong> <?=date("h:i a",time())?></span>
			<span class="pull-right" style="font-size: 0.5em">powered by zeroQu</span>
		</div>
		
	</div>
	
</div>