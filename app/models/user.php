<?php

class User extends DBModel
{
	protected $name;
	protected $age;
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getAge()
	{
		return (int) $this->age;
	}
	
	public function setAge($age)
	{
		$this->age = $age;
	}
}