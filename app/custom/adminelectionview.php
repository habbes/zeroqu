<?php

class AdminElectionView extends AdminView
{
	
	public function renderAdminPage($params, $template)
	{
		
		$this->data->username = $params->admin->getUsername();
		
		$this->data->menu = $this->read("admin_menu");
		parent::renderAdminPage($this->data, $template);
		
	}
}