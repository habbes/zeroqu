<?php

class VoterHandler extends RequestHandler
{
	/**
	 * @var Voter
	 */
	protected $voter;
	
	/**
	 * @var Election
	 */
	protected $election;
	
	/**
	 * ensures that the user is logged-in admin before visiting the requested page.
	 * If the user is a logged-in admin, then the admin property of this object is set,
	 * otherwise the user is redirect to a login page.
	 */
	protected function assertLogin()
	{
		
		if(Login::isVoterLoggedIn()){
			$this->voter = Login::getVoter();
			$this->viewParams->voter = $this->voter;
			$this->viewParams->election = $this->voter->getElection();
		}
		else {
			$this->localRedirect("home");
		}
	}
	
	protected function checkRights($electionName)
	{

		$election = Election::findByName($electionName);
		if(!$election || !$election->is($this->voter->getElection())){
			$this->localRedirect("home");
		}
		$this->election = $election;
	}
	
	public function onCreate($electionName = null)
	{
		$this->assertLogin();
		$this->checkRights($electionName);
	}
}