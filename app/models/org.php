<?php

class Org extends DBModel
{
	protected $name;
	protected $title;
	protected $admin_id;
	protected $created_at;
	
	private $_admin;
	
	public static function create($admin, $name, $title = null)
	{
		$org = new self();
		$org->setAdmin($admin);
		$org->setName($name);
		$org->title = $title? $title : $name;
		$org->created_at = time();
		
		try{
			$org->save();
			
			OrgAdmin::create($org, $admin, OrgAdmin::ROLE_OWNER);
			return $org;
		}
		catch (PDOException $e){
			print_r($e->getMessage());
			return false;
		}
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		if($this->_inDb){
			return false;
		}
		$this->name = $name;
		return true;
	}
	
	public function setAdmin(Admin $admin)
	{
		if($this->_inDb){
			return false;
		}
		$this->_admin = $admin;
		$this->admin_id = $admin->getId();
		return true;
	}
	
	public function getAdmin()
	{
		if(!$this->_admin){
			$this->_admin = Admin::findById($this->admin_id);
		}
		return $this->_admin;
	}
	
	public function validate()
	{
		if(!$this->name || !$this->title || !$this->admin_id){
			return false;
		}
		
		return true;
	}
	
	public function getElections()
	{
		return Election::findByOrg($this);
	}
	
	public function findByName($name)
	{
		return static::findByField('name', $name)->fetch();
	}
	
	public function findByAdmin(Admin $admin)
	{
		return static::findByField('admin_id', $admin->getId())->fetchAll();
	}
	
	public function findByAdminAndName(Admin $admin, $name)
	{
		return static::findOne("admin_id=? AND name=?", [$admin->getId(), $name]);
	}
}