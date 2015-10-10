<?php

class AdminSignupHandler extends RequestHandler
{
	public function post()
	{
		$orgTitle = $this->trimPostVar('title');
		$orgName = $this->trimPostVar('orgName');
		$username = $this->trimPostVar('username');
		$password = $this->postVar('password');
		$confirmPass = $this->postVar("confirm-password");
		
		$errors = [];
		
		if(strlen($password) < 8){
			$errors[] = "Password must be at least 8 characters long.";
		}
		if($password !== $confirmPass){
			$errors[] =  "Passwords did not match.";
		}
		
		if(Org::findByName($orgName)){
			$errors[] = "Identifier is already taken. Please choose another.";
		}
		
		if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Invalid email address provided.";
		}
		
		if(!count($errors)){
			if($admin = Admin::signup($username, $password)){
				if($org = Org::create($admin, $orgName, $orgTitle)){
					Login::adminLogin($admin);
					$this->localRedirect("orgs/".$org->getName());
						
				}
				else {
					$errors[] = "Organization could not be created.";
				}
			}
			else {
				$errors[] = "Admin email is already taken.";
			}
		}
		
		$this->viewParams->signupOrgTitle = $orgTitle;
		$this->viewParams->signupOrgName = $orgName;
		$this->viewParams->signupUsername = $username;
		$this->viewParams->signupErrors = $errors;
		
		return $this->renderView('Home');
		
		
		
	}
}