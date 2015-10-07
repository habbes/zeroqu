<?php 

$url = $data->electionUrl;

?>
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <?php if($data->election){ ?>
	                        <li>
	                            <a href="<?=$url?>"><i class="fa fa-dashboard fa-fw"></i> <strong><?=$data->election->getTitle() ?></strong></a>
	                        </li>
	                        <li>
	                        	<a href="<?=$url?>/view-candidates"><i class="fa fa-cogs"></i> Candidates</a>
	                        </li>
							<?php if($data->election->isOngoing()){ ?>
								<li>
									<a href="#"><i class="fa fa-wrench fa-fw"></i> Vote<span class="fa arrow"></span></a>
					                <ul class="nav nav-second-level">
					                <?php foreach($data->election->getPositions() as $position){ ?>
										<li>
											<a href="<?= $url ?>/vote/<?= urlencode($position->getTitle())?>"><?= $position->getTitle()?></a>
										</li>
									<?php } ?>       
					                </ul>
								</li>
								
							<?php }	?>
							<?php if($data->election->hasEnded()){?>
							<li>
								<a href="<?=$url?>/results"><i class="fa fa-line-chart"></i> Results</a>
							</li>
							<?php } ?>
						<?php }else{ ?>
							<div class="col-md-12 col-xs-12">
								<p>This panel shows the detailed of the selected election
							</div>
							
						<?php } ?>
                    </ul>
                      
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
<!-- <ul class="menu-list">
	<li>
		<a href="<?= $url ?>/view-candidates">Candidates</a>
	</li>
		<?php
			if($data->election->isOngoing()){
		?>
	<li>
		<a>Vote</a>
		<ul class="submenu">
			<?php 
				foreach($data->election->getPositions() as $position){
			?>
				<li><a href="<?= $url ?>/vote/<?= urlencode($position->getTitle())?>"><?= $position->getTitle()?></a></li>
			<?php
				}
			?>
		</ul>
		
		<?php
		}		
		?>
	</li>
	<li>
		<?php 
			if($data->election->hasEnded()){
		?>
			<a href="<?= $url ?>/results">Results</a>
		<?php
			}
		?>
	</li>
</ul>
 -->