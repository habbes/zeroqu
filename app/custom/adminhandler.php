<?php

class AdminHandler extends RequestHandler
{
	protected $admin;
	
	/**
	 * ensures that the user is logged-in admin before visiting the requested page.
	 * If the user is a logged-in admin, then the admin property of this object is set,
	 * otherwise the user is redirect to a login page.
	 */
	protected function assertLogin()
	{
		if(Login::isAdminLoggedIn()){
			$this->admin = Login::getAdmin();
			$this->viewParams->admin = $this->admin;
		}
		else {
			$this->localRedirect("home");
		}
	}
	
	public function onCreate($electionName = null)
	{
		$this->assertLogin();
	}
}