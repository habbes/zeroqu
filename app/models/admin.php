<?php
	
class Admin extends DBModel
{
	
	protected $username;
	protected $password;
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setUsername($name)
	{
		if($this->_inDb){
			return false;
		}
		
		$this->username = $name;
		return true;
	}
	
	public function verifyPassword($password)
	{
		return Utils::verifyPassword($password, $this->password);
	}
	
	public function setPassword($password)
	{
		if($this->_inDb){
			return false;
		}
		$this->password = Utils::hashPassword($password);
		return true;
	}
	
	public function changePassword($new , $old)
	{
		if($this->verifyPassword($old)){
			$this->password = Utils::hashPassword($new);
			return true;
		}
		return false;
		
	}
	
	protected function validate(){
		if(empty($this->username) || empty($this->password)){
			return false;
		}
		
		return true;
	}
	
	public static function signup($username, $password)
	{
		$admin = new self();
		$admin->setUsername($username);
		$admin->setPassword($password);
		
		try{
			if(!$admin->save()){
				return false;
			}
		}
		catch (PDOException $e){
			return false;
		}
		return $admin;
	}
	
	public static function login($username, $password)
	{
		$admin = self::findByUsername($username);
		if($admin && $admin->verifyPassword($password)){
			return $admin;
		}
		else {
			return false;
		}
	}
	
	public function getElections()
	{
		return Election::findByAdmin($this);
	}
	
	public static function findByUsername($username)
	{
		return static::findByField("username", $username)->fetch();
	}
}