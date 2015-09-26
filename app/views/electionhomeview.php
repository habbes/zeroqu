<?php

class ElectionHomeView extends AdminView
{
	public function render($params = null)
	{
		$this->data->election = $params->election;
		$this->data->contentTitle = $params->election->getTitle();
		$this->data->subtitle = $params->election->getTitle();
		$this->data->message = $params->message;
		$this->renderAdminPage($params, "election_home");
	}
}