<?php

abstract class ElectionHandler extends RequestHandler
{
	protected $election;
	
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
		$this->viewParams->election = $election;
	}
	
	public function onCreate($electionName = null)
	{
		parent::onCreate($electionName);
		$this->checkElection($electionName);
	}
}