<?php

class ElectionPositionsView extends AdminView
{
	public function render($params)
	{
		$this->data->election = $params->election;
		$this->data->positions = $params->positions;
		$this->data->contentTitle = $params->election->getTitle() . " - Positions";
		$this->data->subtitle = $params->election->getTitle() . " - Positions";
		$this->data->formResult = $params->formResult;
		$this->renderAdminPage($params, "election_positions");
	}
}