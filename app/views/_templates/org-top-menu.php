<li class="dropdown">
    <a href="<?= $data->orgUrl ?>" class="dropdown-toggle" data-toggle="dropdown">
    	<i class="fa fa-university"></i> <?= $data->org->getTitle() ?>
        <span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li><a href="<?= $data->orgUrl?>/elections"><i class="fa fa-tasks"></i> Elections</a>
		<li class="divider"></li>
		<li><a href="<?= URL_ROOT ?>"><i class="fa fa-external-link"></i> Change Organization</a></li>
	</ul>
</li>