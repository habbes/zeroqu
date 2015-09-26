
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
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i> Elections</a>
                        </li>
                        <li>
                        	<a href="/new-election"><i class=""></i> New Election</a>
                        </li>
                        <?php foreach($data->elections as $election){
                         $url = $election->getName();
                        ?>
                        <li>
                            <a href="<?=$url?>"><i class="fa fa-bar-chart-o fa-fw"></i> <?=$election->getTitle()?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?=$url?>/settings">Settings</a></li>
								<li><a href="<?=$url?>/positions">Positions</a></li>
								<li><a href="<?=$url?>/candidates">Candidates</a></li>
								<li><a href="<?=$url?>/voters">Voters</a></li>
								<li><a href="<?=$url?>/results">Results</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>