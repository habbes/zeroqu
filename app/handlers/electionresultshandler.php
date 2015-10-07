<?php

class ElectionResultsHandler extends ElectionHandler
{
	public $admin;
	public $voter;
	
	
	protected function assertLogin()
	{
		if(Login::isAdminLoggedIn()){
			$this->admin = Login::getAdmin();
			$this->viewParams->admin = $this->admin;
		}
		else if(Login::isVoterLoggedIn()){
			$this->voter = Login::getVoter();
			$this->viewParams->voter = $this->voter;
		}
		else {
			$this->localRedirect("home");
		}
	}
	
	public function onCreate($orgName, $electionName)
	{
		parent::onCreate($orgName, $electionName);
		$election = $this->election;
		if(Login::isAdminLoggedIn()){
			$admin = Login::getAdmin();
			if($election->getAdmin()->is($admin)){
				$this->admin = $admin;
				$this->viewParams->admin = $admin;
				$access = true;
			}
		}
		else if(Login::isVoterLoggedIn()){
			$voter = Login::getVoter();
			if($election->is($voter->getElection())){
				$this->voter = $voter;
				$this->viewParams->voter = $voter;
				$access = true;
			}
		}
		
		if(!$access){
			$this->localRedirect("home");
		}
		$this->viewParams->election = $election;
	}
	
	public function get($id)
	{
		if(Login::isAdminLoggedIn()){
			$this->showAdminPage();
		}
		else if(Login::isVoterLoggedIn()){
			$this->showVoterPage();
		}
	}
	
	public function showAdminPage()
	{
		$this->viewParams->election = $this->election;
		$this->viewParams->positions = $this->election->getPositions();
		$this->renderView("AdminResults");
	}
	
	public function showVoterPage()
	{
		$this->viewParams->election = $this->election;
		$this->viewParams->positions = $this->election->getPositions();
		$this->renderView("VoterResults");
	}
	
}