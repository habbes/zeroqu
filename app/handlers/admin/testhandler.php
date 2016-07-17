<?php

class TestHandler extends AdminElectionHandler
{
	public function get($name="", $id="")
	{
		$v = new Voter();
		$voters = $this->election->getVotersWhere("status=?",[Voter::EMAIL_FAILED]);
		foreach($this->election->getCustomProperties() as $property){
			foreach($voters as $voter){
				if($voter)
				print_r($voter->getCustomValue($property)->getValue());
			}
		}
	}
}