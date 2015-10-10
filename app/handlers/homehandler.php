<?php

class HomeHandler extends RequestHandler
{
	
	public function get()
	{
		if(Login::isAdminLoggedIn()){
			$this->showAdminPage();
		}
		else if(Login::isVoterLoggedIn()){
			$this->showVoterPage();
		}
		else {
			$this->showLoginPage();
		}
		
	}
	
	public function post()
	{
		$form = $this->postVar("form");
		if($form == "signin"){
			$this->adminLogin();
		}
		else if($form == "signup"){
			$this->adminSignup();
		}
		
		
		$this->showLoginPage();
	}
	
	public function showLoginPage()
	{
		$this->renderView('Home');
	}
	
	public function showAdminPage()
	{
		$this->viewParams->admin = Login::getAdmin();
		$this->renderView("AdminHome");
	}
	
	public function showVoterPage()
	{
		$voter = Login::getVoter();
		$this->viewParams->voter = $voter;	
		$this->viewParams->election = $voter->getElection();
		$this->viewParams->electionUrl = URL_ROOT . "/orgs/" . $voter->getElection()->getOrg()->getName()
			. "/elections/" . $voter->getElection()->getName();
		$this->viewParams->org = $voter->getElection()->getOrg();
		if($voter->getElection()->isPending()){
			$this->renderView("VoterCandidates");
		}
		else if($voter->getElection()->isOngoing()){
			$this->renderView('VoterVote');
		}
		else if($voter->getElection()->hasEnded()){
			$this->renderView('VoterResults');
		}
	}
	
	private function adminLogin()
	{
		$username = trim($this->postVar("username"));
		$password = trim($this->postVar("password"));
	
		if($admin = Admin::login($username, $password)){
			Login::adminLogin($admin);
			$this->localRedirect("home");
		}
		$this->viewParams->loginError = "Incorrect username or password.";
		$this->viewParams->loginUsername = $username;
	}
	
	private function adminSignup()
	{
		$username = trim($this->postVar("username"));
		$password = $this->postVar("password");
		$confirmPass = $this->postVar("confirm-password");
		
		$orgname = trim($this->postVar('name'));
		$orgtitle = trim($this->postVar('title'));
		
		if($password && $password == $confirmPass){
			if($admin = Admin::signup($username, $password)){
				
				if($org = Org::create($admin, $orgname, $orgtitle)){
					Login::adminLogin($admin);
					$this->localRedirect("orgs/".$org->getName());
					
				};				
			}
		}
		
		$this->viewParams->signupError = "Account creation failed.";
		$this->viewParams->signupUsername = $username;
		
	}
	
	
}