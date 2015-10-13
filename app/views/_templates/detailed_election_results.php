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
	    <h3><?=$data->election->getTitle()?></h3>
	    <p>Here are graphical representations of the results...</p>
	    <p>Use the tabs above to view</p>
	  </div>
	  
	</div>
</div>
<script>
<?php foreach($data->results['positions'] as $position){
		$candidates = "";
		$votes = "";
		foreach ($position['candidates'] as $candidate){
			$candidates .= "'" . $candidate['name'] . "',";
			$votes .= $candidate['votes'] . ",";
		}
		$candidates = trim($candidates,",");
		$votes = trim($votes,",");
		
		$candidates = "[" . $candidates . "]";
		$votes = "[" . $votes . "]";
	?>
$(function() {
     var chart1 = new Highcharts.Chart({
         chart: {
            renderTo: '<?=str_replace(" ", "-", $position['title'])?>',
            type: 'column'
         },
         rangeSelector: {
            selected: 1
         },
         title: {
			text: "<?=$position['title']?>"
         },
         xAxis: {
			categories: <?=$candidates?>,
			tickInterval: 1
         },
         yAxis: {
             title: {
				text: "Votes"	
             },
             tickInterval: 1
         },
         series: [{
            name: 'Votes',
            data: <?=$votes?> // predefined JavaScript array
         }]
      });
   });
   
 <?php } ?>
</script>