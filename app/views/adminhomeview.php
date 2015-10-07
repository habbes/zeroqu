<?php

class AdminHomeView extends AdminView
{
	public function render($options = null)
	{
		$this->data->subtitle = "Admin Home";
		$this->data->contentTitle = "Organizations";
		$this->renderAdminPage($options, "admin-orgs");
	}
}