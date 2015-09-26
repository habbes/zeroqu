<?php

class ElectionCandidatesView extends AdminView
{
	public function render($params = null)
	{
		$this->data->election = $params->election;
		$this->data->positions = $params->positions;
		$this->data->contentTitle = $params->election->getTitle() . " - Candidates";
		$this->data->subtitle = $params->election->getTitle() . " - Candidates";
		$this->data->formResult = $params->formResult;
		$this->renderAdminPage($params, "election_candidates");
	}
}