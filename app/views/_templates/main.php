<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= URL_ROOT?>">zero<b>Q</b>u</a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
            	<ul class="nav navbar-nav top-links navbar-right">
		    	<?= $data->topMenu ?>
	    	
		    	<?= $data->userMenu?>
		    	</ul>
		    		    	
		    </div>
        </div>    
        </nav>
            <!-- /.navbar-top-links -->
		<?=$data->menu ?>
             <!-- /.navbar-static-side -->
        

        <div id="page-wrapper" class="container <?= !$data->menu? 'full-width' : '' ?>">
            <div class="row">
                <div class="">
                	<?php if($data->contentTitle){ ?>
                    <h1 class="page-title"><?=$data->contentTitle?></h1>
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


