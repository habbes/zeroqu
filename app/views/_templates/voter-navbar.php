<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-user"></i> <?= $data->voter->getVoterId() ?> <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu">
			<li><a href="logout"><i class="fa fa-sign-out"></i> Log Out</a>
		</ul>
	</li>
</ul>