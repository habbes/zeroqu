<?php

class ElectionPositionsHandler extends AdminElectionHandler
{
	
	private function showPositionsPage()
	{
		$this->viewParams->positions = $this->election->getPositions();
		$this->renderView("ElectionPositions");
	}
	
	public function get($name)
	{
		$this->showPositionsPage();
	}
	
	public function post()
	{
		
		$action = isset($_POST['action'])? $_POST['action'] : "";
		$position_id = isset($_POST['position'])? (int) $_POST['position'] : 0;
		$title = isset($_POST['title'])? trim($_POST['title']) : "";
		$description = isset($_POST['description'])? trim($_POST['description']) : "";
		
		switch($action){
			case "create":
				$this->createPosition($title, $description);
				break;
			case "edit":
				$this->editPosition($position_id, $title, $description);
				break;
			case "delete":
				$this->deletePosition($position_id);
				break;
			default:
				$this->showPositionsPage();
		}
	}
	
	public function createPosition($title, $description)
	{
		if(!$title){
			$this->viewParams->formResult = "Error: Title must not be empty";
		}
		else{
			$position = Position::create($this->election, $title, $description);
			
			if(!$position){
				$this->viewParams->formResult = "Position not created.";
			}
		}
		$this->showPositionsPage();
		
	}
	
	public function editPosition($id, $title, $description)
	{
		$position = Position::findByElectionAndId($this->election, $id);
		if(!$position){
			$this->viewParams->formResult = "Error: Position not found.";
		}
		else {
			$position->setTitle($title);
			$position->setDescription($description);
			try {
				$position->save();
			}
			catch (PDOException $e){
				$this->viewParams->formResult = "Position not edited.";
			}
		}
		
		$this->showPositionsPage();
	}
	
	public function deletePosition($id)
	{
		$position = Position::findByElectionAndId($this->election, $id);
		if(!$position){
			$this->viewParams->formResult = "Error: Position not found.";
		}
		else {
			try {
				$position->delete();
			}
			catch (PDOException $e){
				$this->viewParams->formResult = "Position not deleted.";
			}
		}
		
		$this->showPositionsPage();
	}
	
	public function createRule(){
		$positionId = $this->postVar('position');
		$propertyId = $this->postVar('property');
		$name = $this->postVar('name');
		$value = $this->postVar('value');
		
		$position = $this->election->getPositionById($positionId);
		if(!$position){
			$this->viewParams->formResult = 'Error: position not found';
			return $this->showPositionsPage();
		}
		$property = $this->election->getPropertyById($propertyId);
		if(!$property){
			$this->viewParams->formResult = 'Error: position not found';
			return $this->showPositionsPage();
		}
		$ruleType = new PropertyEqualsRule();
		$ruleType->property_id = $property->getId();
		$ruleType->value = $value;
		try{
			$rule = $position->createCustomRule($ruleType, $name);
			$this->viewParams->formResult = 'Rule created successfully.';
		}
		catch(Exception $e){
			$this->viewParams->formResult = 'Error occured while creating rule.';
		}
		$this->showPositionsPage();
		
		
	}
	
	public function deleteRule()
	{
		$posId = $this->postVar('position');
		$ruleId = $this->postvar('rule');
		$position = $this->election->getPositionById($posId);
		if(!$position){
			$this->viewParams->formResult = 'Error: position not found.';
			return $this->showPositionsPage();
		}
		$rule = $position->getCustomRuleById($ruleId);
		if(!$rule){
			$this->viewParams->formResult = 'Error: rule not found.';
			return $this->showPositionsPage();
		}
		try {
			$rule->delete();
			$this->viewParams->formResult = 'Rule deleted successfully.';
		}
		catch(Exception $e){
			$this->viewParams->formResult = 'Error: rule not delete.';
		}
		$this->showPositionsPage();
	}
}