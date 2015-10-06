<?php

class AdminHomeView extends AdminElectionView
{
	public function render($options = null)
	{
		$this->data->subtitle = "Admin Home";
		$this->renderAdminPage($options, "admin_home");
	}
}