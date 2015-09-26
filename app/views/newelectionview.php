<?php

class NewElectionView extends AdminView
{
	public function render($params = null)
	{
		$this->data->contentTitle = "New Election";
		$this->data->subtitle = "New Election";
		$this->renderAdminPage($params, "new_election");
	}
}