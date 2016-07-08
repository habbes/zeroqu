<?php

class NewElectionHandler extends BaseAdminOrgHandler
{
	public function get()
	{
		$this->showForm();
	}
	
	public function post()
	{
		$attribute_types = $_POST["attribute_types"];
		$attribute_names = $_POST["attribute_names"];

		$title = $_POST['title'];
		$name = $_POST['id'];
	
		if($election = Election::create($this->org, Login::getAdmin(), $name, $title)){
			foreach($attribute_types as $key=>$type){
				if($attribute_names[$key] !== "" && $type !== ""){
					$election->createCustomProperty($attribute_names[$key], $type);
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