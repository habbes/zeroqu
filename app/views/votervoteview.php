<?php

class VoterVoteView extends VoterView
{
	public function render($params)
	{
		$this->data->position = $params->position;
		$this->data->candidates = $params->candidates;
		$this->data->formResult = $params->formResult;
		$this->data->subtitle = "Vote - ".$params->position->getTitle();
		$this->data->contentTitle = "Vote - ".$params->position->getTitle();
		$this->data->inlineStyles = [$this->readPath("static/css/voter_vote.css")];
		$this->renderVoterPage($params, "voter_vote");
	}
}