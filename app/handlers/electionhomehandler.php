<?php

class ElectionHomeHandler extends RequestHandler
{
	
	private $admin;
	private $voter;
	private $election;
	
	
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
	
	public function onCreate($electionName)
	{
		$access = false;
		$election = Election::findByName($electionName);
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
	
	private function showVoterPage()
	{
		$this->renderView("VoterHome");
	}
	
	private function showAdminPage()
	{
		if(isset($_GET['saved'])){
			$this->viewParams->message = "Election details saved successfully.";
		}
		else if(isset($_GET['started'])){
			$this->viewParams->message = "Election process has started.";
		}
		else if(isset($_GET['ended'])){
			$this->viewParams->message = "Election process has ended.";
		}
		$this->renderView("ElectionHome");
	}
	
}