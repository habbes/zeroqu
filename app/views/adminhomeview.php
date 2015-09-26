<?php

class AdminHomeView extends AdminView
{
	public function render($options = null)
	{
		$this->data->subtitle = "Admin Home";
		$this->renderAdminPage($options, "admin_home");
	}
}