<div class="container">
	<h1 class="section-title title-underline heading-highlight"><?= $data->election->getTitle() ?>
		<div><small class=""><i class="fa fa-university"></i> <?= $data->election->getOrg()->getTitle() ?></small></div>
	</h1>
	<h2>Election Results</h2>

	<div class="panel-group" id="accordion">
		<?php if(count($data->positions) == 0) { ?>
		<div class="well">No position has been defined for this election .</div>
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
                    		<?php $positionVotes = $position->countVotes(); ?>
                    		<b>Total Votes: <span class="badge"><?= $positionVotes ?></span></b>
                    	</p>
                        <p class="well">
                        	<i class="fa fa-info-circle fa-pull-left" title="Position's description"></i> <?= $position->getDescription() ?>
                        </p>
                        <h4 class="text-lg" style="padding-left:5px" class="normal-title">Candidates</h4>
               			<div class="list-group">
                    	<?php 
                    		$candidates = $position->getCandidates();
                    		uasort($candidates, function($a, $b){
                    			$res = $b->countVotes() - $a->countVotes();

                    			return $res !== 0? $res : strcmp($a->getName(), $b->getName());
                    		});
                    		$rank = 0;
                    		foreach($candidates as $candidate){
                    		$rank++;
                    		$candidateVotes = $candidate->countVotes();
                    		
                    		$imagePath = URL_ROOT . "/" .($candidate->getImagePath()? $candidate->getImagePath() : "public/images/generic-user-96.png");
                    		?>
	                        <div class="list-group-item">
	                            <div class="">
	                            	<h4 class="list-group-item-heading"><?= $rank . ". " . $candidate->getName()?></h4>
	                            	<div class="col-md-3">
	                            		<img style="" class="candidate-photo" src="<?= $imagePath ?>" alt="...">
	                            	</div>
	                            	<div class="col-md-9">
	                            		<div class="vote-result-wrapper">
		                            		<div class="vote-percent">
		                            			<?php printf("%.2f%%", $positionVotes > 0? $candidateVotes * 100/$positionVotes : 0); ?>
		                            		</div>
		                            		<div class="vote-count">
		                            			<b>Votes:</b> <span class="badge"><?= $candidateVotes ?></span>
		                            		</div>
	                            		</div>
	                            		
	                            	</div>
	                            	<div class="clearfix"></div>
	                              	
	                            </div>
	                        </div>
                        <?php } ?>
                        </div>
                        <?php if(count($position->getCandidates()) == 0) { ?>
                        	<p class="well">No candidate was specified for this position.</p>
                        <?php } ?>
                   		
                       
                    </div>
                </div>
            </div>
	        <?php } ?>
	 
	    </div>
</div>