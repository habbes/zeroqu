<?php

class ElectionVotersView extends AdminView
{
	public function render($params)
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