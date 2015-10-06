<?php

class BaseAdminOrgHandler extends AdminHandler
{
	public $org;
	public $orgUrl;
	public $orgAdmin;
	
	public function checkOrg($orgName)
	{
		$org = Org::findByName($orgName);
		if(!$org){
			$this->localRedirect("home");
		}
		$orgAdmin = OrgAdmin::findByOrgAndAdmin($org, $this->admin);
		if(!$orgAdmin){
			$this->localRedirect("home");
		}
		
		$this->org = $org;
		$this->orgAdmin = $orgAdmin;
		$this->viewParams->org = $org;
		$this->viewParams->orgAdmin = $orgAdmin;
		$this->orgUrl = URL_ROOT . "/orgs/".$org->getName();
		$this->viewParams->orgUrl = $this->orgUrl;
	}
	
	public function onCreate($orgName){
		parent::onCreate();
		$this->checkOrg($orgName);
	}
}