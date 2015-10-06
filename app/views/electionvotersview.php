<?php

class ElectionVotersView extends AdminElectionView
{
	public function render($params = null)
	{
		$this->data->election = $params->election;
		$this->data->positions = $params->positions;
		$this->data->voters = $params->voters;
		$this->data->contentTitle = $params->election->getTitle() . " - Voters";
		$this->data->subtitle = $params->election->getTitle() . " - Voters";
		$this->data->formResult = $params->formResult;
		$this->data->inlineStyles = [$this->readPath("static/css/election_voters.css")];
		$this->renderAdminPage($params, "election_voters");
	}
}