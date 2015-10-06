<?php

class OrgHomeView extends AdminView
{
	public function render()
	{
		$this->renderAdminPage($this->data, "admin-org-elections");
	}
}