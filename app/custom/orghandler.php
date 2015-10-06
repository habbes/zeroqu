<?php

class OrgHandler extends RequestHandler
{
	/**
	 * 
	 * @var Org
	 */
	public $org;
	public $orgUrl;
	
	public function checkOrg($orgName)
	{
		$org = Org::findByName($orgName);
		if(!$org){
			$this->localRedirect("home");
		}
		$this->org = $org;
		$this->viewParams->org = $org;
		$this->orgUrl = URL_ROOT . "/orgs/".$org->getName();
		$this->viewParams->orgUrl = $this->orgUrl;
		$this->orgUrl = URL_ROOT . "/orgs/".$org->getName();
		$this->viewParams->orgUrl = $this->orgUrl;
	}
	
	public function onCreate($orgName = null)
	{
		$this->checkOrg($orgName);
	}
}