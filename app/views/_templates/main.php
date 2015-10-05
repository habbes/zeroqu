    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">zeroQu</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
            	<?php if(Login::isAdminLoggedIn()){ ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> Elections <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                    	<?php 
                    	$count = 0;
                    	foreach($data->elections as $election){ 
                    	if($count <= 2){?>
                        <li>
                            <a href="/<?=$election->getName()?>">
                                <div>
                                    <strong><?=$election->getName()?></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Status: </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php }
                    		$count++;
                    	} ?>
                    	 <li>
                        	<a class="text-center" href="/new-election">
	                        	<div class="text-success">
	                        		<strong><i class="fa fa-plus"></i> New Election</strong>
								</div>
								<div>
									<div>Add a new election</div>
								</div>
                        	</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="/">
                                <strong>All Elections</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>                           
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
              
                    <?php } ?>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?= Login::isAdminLoggedIn()? "admin" : "voter" ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            </nav>
            <!-- /.navbar-top-links -->
			<?=$data->menu?>
             <!-- /.navbar-static-side -->
        

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                	<?php if($data->contentTitle){ ?>
                    <h1 class="page-header"><?=$data->contentTitle?></h1>
                    <?php } ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
            	
				<?=$data->content?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
</body>

</html>
