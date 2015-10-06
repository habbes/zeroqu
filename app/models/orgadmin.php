<?php

class OrgAdmin extends DBModel
{
	
	protected static $table = "org_admins";
	
	protected $org_id;
	protected $admin_id;
	protected $role;
	protected $permissions;
	protected $created_at;
	
	private $_org;
	private $_admin;
	
	const ROLE_OWNER = 'owner';
	
	
	public static function create(Org $org, Admin $admin, $role)
	{
		$orgadmin = new self();
		$orgadmin->setOrg($org);
		$orgadmin->setAdmin($admin);
		$orgadmin->role = $role;
		$orgadmin->created_at = time();
		
		try{
			$orgadmin->save();
			return $orgadmin;
		}
		catch (PDOException $e){
			return false;
		}
	}
	
	private function setOrg(Org $org)
	{
		$this->org_id = $org->getId();
		$this->_org = $org;
	}
	
	public function getOrg()
	{
		if(!$this->_org){
			$this->_org = Org::findById($this->org_id);
		}
		return $this->_org;
	}
	
	private function setAdmin(Admin $admin)
	{
		$this->admin_id = $admin->getId();
		$this->_admin = $admin;
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
		return true;
	}
	
	public static function findByOrgAndAdmin(Org $org, Admin $admin)
	{
		return static::findOne('org_id=? AND admin_id=?', [$org->getId(), $admin->getId()]);
	}
	
	public static function findOrgsByRole(Admin $admin, $role)
	{
		$orgs = [];
		$res  = static::find('admin_id=? AND role=?', [$admin->getId(), $role]);
		while($org = $res->fetch()){
			$orgs[] =$org;
		}
		return $orgs;
	}
	
	public static function findOrgs(Admin $admin)
	{
		$orgs = [];
		$res  = static::findByField('admin_id', $admin->getId());
		while($org = $res->fetch()){
			$orgs[] =$org;
		}
		return $orgs;
	}
	
	public static function findAdmins(Org $org)
	{
		$admins = [];
		$res  = static::findByField('org_id', $org->getId());
		while($admin = $res->fetch()){
			$admins[] = $admin;
		}
		return $admins;
	}
	
	
}