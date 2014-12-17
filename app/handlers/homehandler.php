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
		if($form == "admin"){
			$this->adminLogin();
		}
		else if($form == "voter"){
			$this->voterLogin();
		}
		
		switch($form){
			case "admin-login":
				$this->adminLogin();
				break;
			case "admin-signup":
				$this->adminSignup();
				break;
			case "voter-login":
				$this->voterLogin();
				break;
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
		$this->renderView("VoterHome");
	}
	
	private function adminLogin()
	{
		$username = trim($this->postVar("username"));
		$password = trim($this->postVar("password"));
		
		if($admin = Admin::login($username, $password)){
			Login::adminLogin($admin);
			$this->localRedirect("home");
		}
		$this->viewParams->loginResult = "Login failed";
	}
	
	private function adminSignup()
	{
		$username = trim($this->postVar("username"));
		$password = trim($this->postVar("password"));
		$confirmPass = $this->postVar("confirm_password");
		
		if($password && $password == $confirmPass){
			if($admin = Admin::signup($username, $password)){
				Login::adminLogin($admin);
				$this->localRedirect("home");
			}
		}
		$this->viewParams->signupResult = "Signup failed";
	}
	
	private function voterLogin()
	{
		$eId = trim($this->postVar("election"));
		$vId = trim($this->postVar("voter"));
		$password = trim($this->postVar("password"));
		
		if($voter = Voter::login($vId, $eId, $password)){
			Login::voterLogin($voter);
			$this->localRedirect("home");
		}
		$this->viewParams->voterLoginResult = "Login failed";
	}
	
}