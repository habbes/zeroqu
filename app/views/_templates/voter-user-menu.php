<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i> <?= $data->voter->getVoterId(); ?> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li class="divider"></li>
        <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
    </ul>
</li>		