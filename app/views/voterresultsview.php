<?php

class VoterResultsView extends VoterView
{
	public function render($params)
	{
		$this->data->election = $params->election;
		$this->data->positions = $params->election->getPositions();
		$this->data->contentTitle = $params->election->getTitle() . " - Results";
		$this->data->subtitle = $params->election->getTitle() . " - Results";
		$this->renderVoterPage($params, "election_results");
	}
}