<?php

class Session extends DataObject {

	private static $instance = null;

	public function __construct(){
		session_start();
		if(!isset($_SESSION["data"])){
			$_SESSION["data"] = array();
			$_SESSION["startIp"] = $_SERVER["REMOTE_ADDR"];
			$_SESSION["startTime"] = time();
		}
		$this->data = &$_SESSION["data"];
		$_SESSION["lastTime"] = time();
		$_SESSION["lastIp"] = $_SERVER["REMOTE_ADDR"];
	}

	public static function getInstance(){
		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function destroy(){
		//delete all session vars
		$_SESSION = array();

		//delete session cookie
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
		$params['path'], $params['domain'],
		$params['secure'], $params['httponly']
		);

		//destroy session data
		return session_destroy();
	}

	public function __get($name){
		if(array_key_exists($name, $_SESSION)){
			return $_SESSION[$name];
		}
		else {
			return parent::__get($name);
		}
	}

	public function age(){
		return $_SESSION["lastTime"] - $_SESSION["startTime"];
	}

	public function sameIp(){
		return $_SESSION["lastIp"] == $_SESSION["startIp"];
	}

	public function deleteData($key){
		unset($_SESSION["data"][$key]);
	}

}
