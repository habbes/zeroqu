
<!-- <span class="menu-header"><a href="new-election"><span class="new-icon">+</span> New Election</a></span>
<ul class="menu-list">
	<?php 
		foreach($data->elections as $election){
			$url = $election->getName();
		?>
		<li>
			<a class="election-link" href="<?=$url?>"><?= $election->getTitle() ?></a>
			<?php if($data->election && $election->is($data->election)) {?>
			<ul class="submenu">
				<li><a href="<?=$url?>/settings">Settings</a></li>
				<li><a href="<?=$url?>/positions">Positions</a></li>
				<li><a href="<?=$url?>/candidates">Candidates</a></li>
				<li><a href="<?=$url?>/voters">Voters</a></li>
				<li><a href="<?=$url?>/results">Results</a>
			</ul>
			<?php }?>
		</li>
		<?php 
	}?>
</ul>
 -->
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
	                            <a href="<?=$data->election->getName()?>"><i class="fa fa-dashboard fa-fw"></i> <strong><?=$data->election->getTitle() ?></strong></a>
	                        </li>
	                        <?php $url = $data->election->getName(); ?>
	                        <li>
	                        	<a href="<?=$url?>/settings"><i class="fa fa-cogs"></i> Settings</a>
	                        </li>
							<li>
								<a href="<?=$url?>/positions"><i class="fa fa-users"></i> Positions</a>
							</li>
							<li
								><a href="<?=$url?>/candidates"><i class="fa fa-users"></i> Candidates</a>
							</li>
							<li>
								<a href="<?=$url?>/voters"><i class="fa fa-users"></i> Voters</a>
							</li>
							<li>
								<a href="<?=$url?>/results"><i class="fa fa-line-chart"></i> Results</a>
							</li>
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