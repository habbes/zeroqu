<?php

class AdminLoginHandler extends RequestHandler
{
	public function post()
	{
		$username = $this->trimPostVar('username');
		$password = $this->postVar('password');
		if($admin = Admin::login($username, $password)){
			Login::adminLogin($admin);
			$this->localRedirect('home');
		}
		$this->viewParams->loginError = "Login failed. Incorrect email or password.";
		$this->viewParams->loginUsername = $username;
		$this->renderView('Home');
	}
}