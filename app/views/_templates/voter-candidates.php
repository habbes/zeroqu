<div class="container">
	<h1 class="section-title title-underline heading-highlight"><?= $data->election->getTitle() ?>
		<div><small class=""><i class="fa fa-university"></i> <?= $data->election->getOrg()->getTitle() ?></small></div>
	</h1>
	<div class="alert alert-info">The voting process has not yet begun. You can view candidates but you cannot vote.</div>

	<div class="panel-group" id="accordion">
		<?php if(count($data->positions) == 0) { ?>
		<div class="well">No position has been defined for this election yet.</div>
		<?php } ?>

        <?php foreach($data->positions as $position){ ?>
            <div class="panel panel-default">
                <div class="panel-heading" >
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$position->getId()?>"><span>
                        </span><?=$position->getTitle()?></a>

                    </h4>
                </div>
                <div id="collapse<?=$position->getId()?>" class="panel-collapse collapse collapsed">
                    <div class="panel-body">
                        <p class="well">
                        	<i class="fa fa-info-circle fa-pull-left" title="Position's description"></i> <?= $position->getDescription() ?>
                        </p>
                        <h4 class="text-lg" style="padding-left:5px" class="normal-title">Candidates</h4>
                   		
                        	<?php foreach($position->getCandidates() as $candidate){

                        		$imagePath = URL_ROOT . "/" .($candidate->getImagePath()? $candidate->getImagePath() : "public/images/generic-user-96.png");
                        		?>
                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                	<h4 class="section-title title-underline"><?=$candidate->getName()?></h4>
                                  	<img style="height:130px" class="media-object" src="<?= $imagePath ?>" alt="...">
                                </div>
                            </div>
                            <?php } ?>

                            <?php if(count($position->getCandidates()) == 0) { ?>
                            	<p class="well">No candidate has been specified for this position yet.</p>
                            <?php } ?>
                       
                       
                    </div>
                </div>
            </div>
	        <?php } ?>
	 
	    </div>
</div>