<?php

class VoterVoteHandler extends RequestHandler
{
	/**
	 * 
	 * @var Voter
	 */
	public $voter;
	
	/**
	 * 
	 * @var Election
	 */
	public $election;
	
	/**
	 * 
	 * @var Org
	 */
	public $org;
	
	
	private function showPage()
	{
		$positions  = $this->election->getPositions();
		
		$this->viewParams->positions = array_filter($positions, function($position){
			if($this->voter->getVoteByPosition($position)){
				return false;
			}
			return true;
		});
		$this->renderView("voter/Vote");
		
	}
	
	
	public function onCreate()
	{
		if(Login::isVoterLoggedIn()){
			$this->voter = Login::getVoter();
			$this->viewParams->voter = $this->voter;
			$this->election = $this->voter->getElection();
			$this->viewParams->election = $this->election;
			$this->org = $this->election->getOrg();
			$this->viewParams->org = $this->org;
		} else {
			$this->localRedirect('home');
		}
	}
	
	public function get()
	{
		
		$this->showPage();	
		
	}
	
	public function post()
	{
		$position = Position::findById($this->postVar('position'));
		
		if(!$position){
			$this->viewParams->error = "Position not found.";
			$this->showPage();
		}
		$this->position = $position;
		
		if($this->voter->getVoteByPosition($position)){
			$this->viewParams->error = "You have already voted in that position.";
			$this->showPage();
		}
		
		$cId = (int) $this->postVar("candidate");
		$candidate = Candidate::findByPositionAndId($position, $cId);
		
		if(!$candidate){
			$this->viewParams->error = "Candidate not found.";
		}
		else if($vote = Vote::create($this->voter, $candidate)){
			$this->vote = $vote;
			$this->viewParams->success = "Vote casted successfully.";
		}
		else {
			$this->viewParams->error = "Vote not casted successfully";
		}

		$this->showPage();
	}
}