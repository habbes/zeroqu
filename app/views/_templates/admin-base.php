    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">zeroQu</a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
            	<ul class="nav navbar-top-links navbar-right">
            	</ul>
		    	<ul class="nav navbar-nav navbar-right">
		    		
		    		<?php if($data->org){
		    			$orgUrl = $data->orgUrl;
		    			?>
		    		<li class="dropdown">
			    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			    			<i class="fa fa-university"></i> <?= $data->org->getTitle() ?>
			    			<span class="caret"></span>
			    		</a>
		    			<ul class="dropdown-menu">
		    				<li><a href="<?= $orgUrl?>/elections"><i class="fa fa-tasks"></i> Elections</a>
		    				<li class="divider"></li>
		    				<li><a href="<?= URL_ROOT ?>"><i class="fa fa-external-link"></i> Change Organization</a></li>
		    			</ul>
		    		</li>
		    		
		    		<?php } else {?>
		    		<li><a href="<?= URL_ROOT ?>"><i class="fa fa-university"></i> Organizations</a></li>
		    		<?php } ?> 
		    		
		    		<li class="dropdown">
	                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                        <i class="fa fa-user fa-fw"></i> <?= Login::isAdminLoggedIn()? Login::getAdmin()->getUsername() : Login::getVoter()->getVoterId() ?> <i class="fa fa-caret-down"></i>
	                    </a>
	                    <ul class="dropdown-menu dropdown-user">
	                        <li class="divider"></li>
	                        <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
	                        </li>
	                    </ul>
	                    <!-- /.dropdown-user -->
	                </li>		
		    	</ul>
		    		    	
		    </div>
            
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
