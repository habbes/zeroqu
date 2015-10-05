<?php

class VoterLoginHandler extends ElectionHandler
{
	
	public function get($electionName)
	{
		$this->viewParams->voterId = $this->getVar('id');
		$this->renderView('VoterLogin');
	}
	
	public function post()
	{
		
	}
	
	
}