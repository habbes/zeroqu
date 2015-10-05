<?php

class VoterCandidatesView extends VoterView
{
	public function render($params = null)
	{
		$this->data->positions = $params->positions;
		$this->data->subtitle = $params->election->getTitle()." Candidates";
		$this->data->contentTitle = $params->election->getTitle()." Candidates";
		$this->renderVoterPage($params, "voter_candidates");
	}
}