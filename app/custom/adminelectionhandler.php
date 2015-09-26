<?php

class AdminElectionHandler extends AdminHandler
{
	
	protected $election;

	
	/**
	 * checks whether the user is a logged-in admin and allowed to view the request
	 * and redirects if the user does not have rights and sets this object's admin and
	 * election properties if the user has the rights
	 * @param string $electionName the name/id of the election
	 */
	protected function checkRights($electionName)
	{
		$election = Election::findByName($electionName);
		if(!$election || !$this->admin->is($election->getAdmin())){
			$this->localRedirect("home");
		}
		
		$this->election = $election;
		$this->viewParams->election = $this->election;
	}
	
	public function onCreate($electionName = null)
	{
		parent::onCreate($electionName);
		$this->checkRights($electionName);
	}
}