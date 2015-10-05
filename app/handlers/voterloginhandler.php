<?php

class VoterLoginHandler extends ElectionHandler
{
	
	private function showPage()
	{
		$this->renderView('VoterLogin');
	}
	
	public function get($electionName)
	{
		$this->viewParams->voterId = $this->getVar('id');
		$this->showPage();
	}
	
	public function post($electionName)
	{
		
		$vId = trim($this->postVar("id"));
		$password = trim($this->postVar("password"));
		
		if($voter = Voter::login($vId, $this->election->getName(), $password)){
			Login::voterLogin($voter);
			$this->localRedirect("home");
		}
		$this->viewParams->voterId = $vId;
		$this->viewParams->loginError = "Incorrect Voter ID or Password.";
		$this->showPage();
	}
	
	
}