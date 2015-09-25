<?php

if($dbEnv = getenv('CLEARDB_DATABASE_URL')){
	//production
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$hostname = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$dbname = substr($url["path"], 1);

}
else {
	//development
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'elections';

}


/**
 * database configuration
 */
$database = array(
	"hostname" => $hostname,
	"username" => $username,
	"password" => $password,
	"dbname" => $dbname
);

?>