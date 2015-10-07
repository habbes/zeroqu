<?php

class VoterRegEmailView extends EmailView
{
	
	public function renderEmail($params = null)
	{
		$this->data->election = $params->election;
		$this->data->voterId = $params->voterId;
		$this->data->voterPass = $params->voterPass;
		$this->data->url = URL_ROOT . "/orgs/". $params->org->getName()
				.'/elections/'.$params->election->getName().'/voter-login?id='
				.$this->data->voterId;
		return $this->read("emails/voter_reg_email");
	}
}