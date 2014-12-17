<?php

require_once "app/dirs.php";
require_once "app/autoload.php";
require_once "app/routes.php";
require_once "app/urls.php";

$url = isset($_GET['url'])? $_GET['url'] : '';

$app = new Application($url, $routes);
$app->start();