<?php

class VoterLoginHandler extends ElectionHandler
{
	
	public function get($election)
	{
		$this->renderView('VoterLogin');
	}
	
	public function post()
	{
		
	}
	
	
}