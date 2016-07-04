<?php

class ElectionSettingsHandler extends AdminElectionHandler
{
	public function get($name)
	{
		$this->renderView("ElectionSettings");
	}
	
	public function post($name)
	{
		
		if($this->election->hasEnded()){
			if(isset($_POST['release-results'])){
					
				$this->election->releaseResults();
			}
			$this->redirect($this->electionUrl . "/settings");
		}
		
		if(array_key_exists("details", $_POST)){
			$this->saveDetails();
		}
		else if(isset($_POST['change-status'])){
			$this->changeStatus();
		}
		
	}
	
	protected function saveDetails()
	{
		$attribute_types = $_POST["attribute_types"];
		$attribute_names = $_POST["attribute_names"];

		foreach($attribute_types as $key=>$type){
				$this->election->createCustomProperty($attribute_names[$key], $type);
		}
		
		$title = isset($_POST['title'])? trim($_POST['title']) : "";
		$startDate = isset($_POST['start-date'])? trim($_POST['start-date']) : "";
		$startDate = strtotime($startDate);
		$endDate = isset($_POST['end-date'])? trim($_POST['end-date']) : "";
		$endDate = strtotime($endDate);
		
		if($this->election->isPending()){
			if($startDate){
				if($startDate < time() || $startDate > $endDate){
					$this->viewParams->formResult = "Changes were not saved: Invalid Start or End Date.";
					$this->renderView("ElectionSettings");
				}
				$this->election->setStartDate($startDate);
				$this->election->setEndDate($endDate);
			}
		}
		else if($this->election->isOngoing()){
			
			if($endDate && $endDate > $this->election->getStartDate() && $endDate >= time()){
				$this->election->setEndDate($endDate);
			}
			else {
				$this->viewParams->formResult = "Changes were not saved: Invalid End Date.";
				$this->renderView("ElectionSettings");
			}
		}
		
		$this->election->setTitle($title);
		
		if($this->election->save())
		{
			
			$this->redirect($this->electionUrl . "?saved=true");
		}
		else {
			$this->viewParams->formResult = "Changes were not saved.";
			$this->renderView("ElectionSettings");
		}
		
	}
	
	protected function changeStatus()
	{
		$sub = "";
		if($this->election->isPending()){
			$this->election->setStartDate(time());
			$this->election->start();
			$sub = "?started=true";
		}
		else if($this->election->isOngoing()){
			$this->election->setEndDate(time());
			$this->election->end();
			$sub = "?ended=true";
		}
		
		$this->redirect($this->electionUrl . $sub);
	}
	
}