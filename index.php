<?php

require_once "vendor/autoload.php";
require_once "app/dirs.php";
require_once "app/autoload.php";
require_once "app/routes.php";
require_once "app/urls.php";

$dotenv = new Dotenv\Dotenv(DIR_ROOT);
$dotenv->load();

$url = isset($_GET['url'])? $_GET['url'] : '';

$app = new Application($url, $routes);
$app->start();