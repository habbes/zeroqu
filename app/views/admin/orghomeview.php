<?php

class OrgHomeView extends AdminView
{
	public function render()
	{
		$this->data->contentTitle = $this->data->org->getTitle();
		$this->renderAdminPage($this->data, "admin-org-elections");
	}
}