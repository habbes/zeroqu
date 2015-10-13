
		<div class="col col-md-4 col-sm-6" style="margin-top:20px">
			<div class="panel panel-default">

				<div class="panel-body">
					<h4 style="text-align:center"><a href="<?= $data->orgUrl ."/new-election/"?>"><i class="fa fa-plus-circle"></i> New Election</a></h4>
				</div>
			</div>
		</div>
		<?php foreach($data->org->getElections() as $election){
			$electionUrl = $data->orgUrl . "/elections/".$election->getName();
			?>
		<div class="col col-md-4 col-sm-6" style="margin-top:20px">
			<div class="panel panel-default">

				<div class="panel-body">
					<h4 style="text-align:center"><a href="<?= $electionUrl ?>"><?= $election->getTitle() ?></a></h4>
				</div>
			</div>
		</div>
		<?php } ?>
		
