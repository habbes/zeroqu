<?php

class VoterNotVotedView extends VoterView
{
	public function render($params)
	{
		$this->data->position = $params->position;
		$this->data->subtitle = "Your vote - ".$params->position->getTitle();
		$this->data->contentTitle = "Your vote - ".$params->position->getTitle();
		$this->renderVoterPage($params, "voter_not_voted");
	}
}