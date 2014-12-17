<?php

/**
 * loads and provides the database connection
 * @author Habbes
 *
 */
class Database
{
	
	private static $instance;

	/**
	 * sets up a database connection from config script
	 * @return PDO
	 */
	private static function dbFromConfig()
	{
		$ds = DIRECTORY_SEPARATOR;
		require_once DIR_CONFIG.$ds."database.php";
		
		$host = $database['hostname'];
		$user = $database['username'];
		$pass = $database['password'];
		$name = $database['dbname'];
		$db = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	
	/**
	 * the working instance of this class
	 * @return PDO
	 */
	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = self::dbFromConfig();
		}
		return self::$instance;
	}
	
}