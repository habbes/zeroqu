<div class="container">
	<h1 class="section-title title-underline heading-highlight"><?= $data->election->getTitle() ?>
		<div><small class=""><i class="fa fa-university"></i> <?= $data->election->getOrg()->getTitle() ?></small></div>
	</h1>
	<?php if($data->error){ ?>
	<div class="alert alert-danger"><?= $data->error ?></div>
	<?php } ?>
	<?php if($data->success){ ?>
	<div class="alert alert-success"><?= $data->success ?> <i class="fa fa-check"></i></div>
	<?php } ?>
	<div class="alert alert-info"><b>The voting process is ongoing</b>. Cast your vote below.</div>
	
	<div class="panel-group" id="accordion">
		<?php if(count($data->positions) == 0) { ?>
		<div class="well">No position has been defined for this election.</div>
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
                   		<form class="form vote-form" method="post" data-positionId="<?= $position->getId() ?>" action="voter/vote" data-positionTitle="<?= $position->getTitle()?>">
                        	<input type="hidden" name="position" value="<?= $position->getId()?>" >
                        	<?php foreach($position->getCandidates() as $candidate){

                        		$imagePath = URL_ROOT . "/" .($candidate->getImagePath()? $candidate->getImagePath() : "public/images/generic-user-96.png");
                        	?>
                        	<div>
	                            <div class="col-md-4 col-sm-6">
	                                <div class="">
	                                	<h4 class="section-title title-underline"><?=$candidate->getName()?></h4>
	                                	<div class="col-xs-6">
	                                  		<img style="" class="candidate-photo voter-candidate-photo" src="<?= $imagePath ?>" alt="...">
	                                  	</div>
	                                  	<div class="col-xs-6">
	                                  		<input class="vote-radio hidden-xs" type="radio" id="candidate<?= $candidate->getId() ?>" name="candidate" 
	                                  		value="<?= $candidate->getId() ?>" data-name="<?= $candidate->getName() ?>" data-position="<?= $position->getTitle()?>"/>
	                                  		<input class="vote-radio visible-xs-inline pull-right" type="radio" id="candidate<?= $candidate->getId() ?>" name="candidate" 
	                                  		value="<?= $candidate->getId() ?>" data-name="<?= $candidate->getName() ?>" data-position="<?= $position->getTitle()?>"/>
	                                	</div>
	                                	<div class="clearfix"></div>
	                                </div>
	                            </div>
	                        </div>
	                        <?php } ?>

	                        <?php if(count($position->getCandidates()) == 0) { ?>
	                           	<p class="well">No candidate has been specified for this position.</p>
	                        <?php } else {?>

                            
                            <div class="clearfix"></div>
                            <div class="vote-button-container">
	                            <div class="col-md-4 col-md-offset-4">
	                            	<div class="form-group">
	                            		<button class="btn btn-success form-control vote-button"><i class="fa fa-check-square-o"></i> Cast Vote</button>
	                            	</div>
	                            </div>
                            </div>
                       		<?php } ?>
                       	</form>


                    </div>
                </div>
            </div>
	    <?php } ?>
	 
	</div>
</div>
<script>





</script>