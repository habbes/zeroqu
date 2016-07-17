<?php

class NewElectionHandler extends BaseAdminOrgHandler
{
	public function get()
	{
		$this->showForm();
	}
	
	public function post()
	{
		$attribute_names = $_POST["attribute_names"];

		$title = $_POST['title'];
		$name = $_POST['id'];
	
		if($election = Election::create($this->org, Login::getAdmin(), $name, $title)){
			foreach($attribute_names as $name){
				if($name != ""){
					$election->createCustomProperty($name, "text");
				}
			}
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