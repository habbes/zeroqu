<?php

class ElectionCandidatesHandler extends AdminElectionHandler
{
	
	private function showPage()
	{
		$this->viewParams->positions = $this->election->getPositions();
		$this->renderView("ElectionCandidates");
	}
	
	public function get()
	{
		$this->showPage();
	}
	
	public function post()
	{
		$position_id = (int) $this->postVar("position");
		$candidate_id = (int) $this->postVar("candidate");
		$name = $this->postVar("name");
		
		$action = $this->postVar("action");
		
		switch($action){
			case "create":
				$this->addCandidate($position_id, $name);
				break;
			case "edit":
				$this->changeCandidate($candidate_id, $position_id, $name);
				break;
			case "delete":
				$this->removeCandidate($candidate_id);
				break;
			default:
				$this->showPage();
		}
	}
	
	public function addCandidate($pos_id, $name, $picture = "")
	{
		$position = Position::findByElectionAndId($this->election, $pos_id);
		
		
		if(!$position){
			$this->viewParams->formResult = "Error: Position not found.";
		}
		else {
			
			if($candidate = Candidate::create($position, $name)){
				$image = $this->fileVar('picture');
				if($path = $image->tmp_name){
					$candidate->setImage($path);
				}
			}
			else {
				$this->viewParams->formResult = "Error: Candidate not created.";
			}
		}
		
		
		$this->showPage();
	}
	
	public function changeCandidate($id, $pos_id, $name)
	{
		$candidate = Candidate::findByElectionAndId($this->election, $id);
		if($candidate){
			$candidate->setName($name);
			$position = Position::findByElectionAndId($this->election, $pos_id);
			
			if($position){
				$candidate->setPosition($position);
				
			}
			try {
				$image = $this->fileVar('picture');
				if($path = $image->tmp_name){
					$candidate->setImage($path);
				}
				$candidate->save();
			}
			catch (PDOException $e){
				$this->viewParams->formResult = "Error: Candidate not found";
			}
		}
		$this->showPage();
	}
	
	public function removeCandidate($id)
	{
		$candidate = $this->election->getCandidateById($id);
		if($candidate){
			if(!$candidate->delete()){
				$this->viewParams->formResult = "Error: Candidate not removed.";
			}
		}
		else {
			$this->viewParams->formResult = "Error: Candidate not found.";
		}
		
		$this->showPage();
	}
}