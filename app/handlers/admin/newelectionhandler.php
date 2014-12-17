<?php

class NewElectionHandler extends AdminHandler
{
	public function get()
	{
		$this->showForm();
	}
	
	public function post()
	{
		$title = $_POST['title'];
		$name = $_POST['id'];
	
		if($election = Election::create(Login::getAdmin(), $name, $title)){
			$this->localRedirect($election->getName());
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