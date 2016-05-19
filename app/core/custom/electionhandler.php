<?php

abstract class ElectionHandler extends OrgHandler
{
	/**
	 * 
	 * @var Election
	 */
	public $election;
	
	/**
	 * 
	 * @var string
	 */
	public $electionUrl;
	
	/**
	 * Check whether election exists
	 * @param unknown $electionName
	 */
	protected function checkElection($electionName)
	{
		$election = Election::findByName($electionName);
		if(!$election){
			$this->localRedirect('home');
		}
		
		$this->election = $election;
		$this->electionUrl = $this->orgUrl . "/elections/" . $election->getName();
		$this->viewParams->electionUrl = $this->electionUrl;
		$this->viewParams->election = $election;
	}
	
	public function onCreate($orgName, $electionName)
	{
		parent::onCreate($orgName);
		$this->checkElection($electionName);
	}
}