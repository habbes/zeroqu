<?php

class OrgHandler extends RequestHandler
{
	/**
	 * 
	 * @var Org
	 */
	public $org;
	
	public function checkOrg($orgName)
	{
		$org = Org::findByName($orgName);
		if(!$org){
			$this->localRedirect("home");
		}
		$this->org = $org;
		$this->viewParams->org = $org;
	}
	
	public function onCreate($orgName = null)
	{
		$this->checkOrg($orgName);
	}
}