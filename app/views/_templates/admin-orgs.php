
		<div class="col col-md-4 col-sm-6" style="margin-top:20px">
			<div class="panel panel-default">

				<div class="panel-body">
					<h4 style="text-align:center"><a href="<?= URL_ROOT ."/new-org/"?>"><i class="fa fa-plus-circle"></i> New Organization</a></h4>
				</div>
			</div>
		</div>
		<?php foreach(Login::getAdmin()->getOrgs() as $org){?>
		<div class="col col-md-4 col-sm-6">
			<div class="panel panel-default">

				<div class="panel-body">
					<h4 style="text-align:center"><a href="<?= URL_ROOT ."/orgs/".$org->getName() ?>"><?= $org->getTitle() ?></a></h4>
				</div>
			</div>
		</div>
		<?php } ?>		
