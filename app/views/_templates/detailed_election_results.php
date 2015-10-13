<div class="col-md-12">
	<ul class="nav nav-tabs">
		<?php foreach($data->results['positions'] as $position){ ?>
			<li><a data-toggle="tab" href="#<?=str_replace(" ","-",$position['title'])?>"><?=$position['title']?></a></li>
		<?php } ?>
	  	<!-- <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
	  	<li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
	  	<li><a data-toggle="tab" href="#menu2">Menu 2</a></li> -->
	</ul>
	
	<div class="tab-content">
		<?php foreach($data->results['positions'] as $position){ ?>
			 <div id="<?=str_replace(" ","-",$position['title'])?>" class="tab-pane fade">
			    <h3><?=$position['title']?></h3>
			    <p id="<?=str_replace(" ", "-", $position['title'])?>" class="col-md-12"></p>
			  </div>
		<?php } ?>
	  <div id="home" class="tab-pane fade in active">
	    <h3>HOME</h3>
	    <p>Some content.</p>
	  </div>
	  <div id="menu1" class="tab-pane fade">
	    <h3>Menu 1</h3>
	    <p>Some content in menu 1.</p>
	  </div>
	  <div id="menu2" class="tab-pane fade">
	    <h3>Menu 2</h3>
	    <p>Some content in menu 2.</p>
	  </div>
	</div>
</div>
<script>
<?php foreach($data->results['positions'] as $position){?>
$(function() {
     var chart1 = new Highcharts.Chart({
         chart: {
            renderTo: '<?=str_replace(" ", "-", $position['title'])?>',
            type: 'bar'
         },
         rangeSelector: {
            selected: 1
         },
         series: [{
            name: 'USD to EUR',
            data: [43,45,65,76,56] // predefined JavaScript array
         }]
      });
   });
   
 <?php } ?>
</script>