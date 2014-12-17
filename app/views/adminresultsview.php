<?php

class AdminResultsView extends AdminView
{
	public function render($params)
	{
		$this->data->election = $params->election;
		$this->data->positions = $params->election->getPositions();
		$this->data->contentTitle = $params->election->getTitle() . " - Results";
		$this->data->subtitle = $params->election->getTitle() . " - Results";
		$this->renderAdminPage($params, "election_results");
	}
}

