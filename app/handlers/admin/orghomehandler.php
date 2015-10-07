<?php

class OrgHomeHandler extends BaseAdminOrgHandler
{
	public function get()
	{
		$this->renderView('admin/OrgHome');
	}
}