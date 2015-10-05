<?php

class VoterVotedView extends VoterView
{
	public function render($params = null)
	{
		$this->data->position = $params->position;
		$this->data->candidate = $params->candidate;
		$this->data->subtitle = "Your vote - ".$params->position->getTitle();
		$this->data->contentTitle = "Your vote - ".$params->position->getTitle();
		$this->renderVoterPage($params, "voter_voted");
	}
}