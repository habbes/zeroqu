<?php

class ElectionSettingsView extends AdminView
{
	public function render($params = null)
	{
		$this->data->election = $params->election;
		$this->data->contentTitle = $params->election->getTitle() . " - Settings";
		$this->data->subtitle = $params->election->getTitle() . " - Settings";
		$this->data->formResult = $params->formResult;
		$this->renderAdminPage($params, "election_settings");
	}
}