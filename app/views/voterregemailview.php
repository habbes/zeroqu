<?php

class VoterRegEmailView extends EmailView
{
	
	public function renderEmail($params)
	{
		$this->data->election = $params->election;
		$this->data->voterId = $params->voterId;
		$this->data->voterPass = $params->voterPass;
		$this->data->url = URL_ROOT;
		return $this->read("emails/voter_reg_email");
	}
}