<?php

class LogoutHandler extends RequestHandler
{
	public function get()
	{
		$dest = "home";
		if(Login::isVoterLoggedIn()){
			$voter = Login::getVoter();
			$dest = $voter->getElection()->getName() . "/voter-login?id="
					. $voter->getId();	
		}
		Login::logout();
		$this->localRedirect($dest);
	}
}