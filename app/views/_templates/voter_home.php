<?php 
if($data->election->isOngoing()){
?>
<p>
The voting process is ongoing. You can vote for your candidates by opening their respective
Position's link under the Vote menu.
</p>
<?php 
}
else if($data->election->isPending()) {
?>

        <div class="col-sm-12" style="margin-top: 20px">	 
		<div class="alert alert-warning">The voting process has not yet begun. You can view candidates but you cannot vote.</div>
        	
            <div class="panel-group" id="accordion">
            <?php foreach($data->election->getPositions() as $position){ ?>
                <div class="panel panel-default">
                    <div class="panel-heading" >
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$position->getId()?>"><span>
                            </span><?=$position->getTitle()?></a>
                        </h4>
                    </div>
                    <div id="collapse<?=$position->getId()?>" class="panel-collapse collapse collapsed">
                        <div class="panel-body">
                            <table class="table">
                            	<?php foreach($position->getCandidates() as $candidate){

                            		$imagePath = URL_ROOT . "/" .($candidate->getImagePath()? $candidate->getImagePath() : "public/images/generic-user-96.png");
                            		?>
                                <tr>
                                    <td>
                                    <h4><?=$candidate->getName()?></h4>
                                        <div class="media">
										  <div class="media-left">
										    <a href="#">
										      <img style="max-height:100px" class="media-object" src="<?= $imagePath ?>" alt="...">
										    </a>
										  </div>
										  <div class="media-body">
										    <h4 class="media-heading"></h4>
										  </div>
										</div>
                                    </td>
                                </tr>
                                <?php } ?>
                              
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
 
            </div>
        </div>


<?php 

}
else if($data->election->hasEnded()) {
?>
<p>
The voting process has ended. You can view the candidates but you cannot cast a vote.
</p>
<?php 
}
?>
