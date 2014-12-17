<?php

class VoterHomeView extends VoterView
{
	public function render($params)
	{
		$this->data->subtitle = "Voter Home";
		$this->renderVoterPage($params, "voter_home");
	}
}