<?php

class NewElectionHandler extends BaseAdminOrgHandler
{
	public function get()
	{
		$this->showForm();
	}
	
	public function post()
	{
		$title = $_POST['title'];
		$name = $_POST['id'];
	
		if($election = Election::create($this->org, Login::getAdmin(), $name, $title)){
			$this->redirect($this->orgUrl . "/elections/" . $election->getName());
		}
		else {
			$this->showForm();
		}
		
	}
	
	protected function showForm()
	{
		$this->renderView("NewElection");
	}
}