<?php
/**
 * autoload handler
 */
require_once "dirs.php";

function autoload($class)
{
	$dirs = [DIR_APP, DIR_CORE, DIR_HANDLERS, DIR_MODELS, DIR_VIEWS, DIR_CONFIG, DIR_CUSTOM];
	
	foreach($dirs as $dir){
		
		$path = $dir . DIRECTORY_SEPARATOR . strtolower($class) . ".php";
		if(file_exists($path)){
			include $path;
			return;
		}
	}
}

spl_autoload_register('autoload');