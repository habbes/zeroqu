<?php

class VoterVoteHandler extends VoterHandler
{
	
	public $position;
	public $vote;
	private function showVotingPage()
	{
		$this->viewParams->position = $this->position;
		$this->viewParams->candidates = $this->position->getCandidates();
		$this->renderView("VoterVote");
	}
	
	private function showVotedPage()
	{
		$this->viewParams->position = $this->position;
		$this->viewParams->candidate = $this->vote->getCandidate();
		$this->renderView("VoterVoted");
	}
	
	private function showNotVotedPage()
	{
		$this->viewParams->position = $this->position;
		$this->renderView("VoterNotVoted");
	}
	
	public function onCreate($orgName,$electionName)
	{
		parent::onCreate($orgName, $electionName);
		if($this->election->isPending()){
			$this->localRedirect("home");
		}
	}
	
	public function get($orgName, $electionName, $positionTitle)
	{
		$position = Position::findByElectionAndTitle($this->election, $positionTitle);
		
		if(!$position){
			$this->localRedirect("home");
		}
		
		$this->position = $position;
		
		if($vote = $this->voter->getVoteByPosition($position)){
			$this->vote = $vote;
			$this->showVotedPage();
		}
		else if($this->election->hasEnded()){
			$this->showNotVotedPage();
		}
		else {
			$this->showVotingPage();
		}
		
		
	}
	
	public function post($orgName, $electionName, $positionTitle)
	{
		$position = Position::findByElectionAndTitle($this->election, $positionTitle);
		
		if(!$position){
			$this->localRedirect("home");
		}
		$this->position = $position;
		
		$cId = (int) $this->postVar("candidate");
		$candidate = Candidate::findByPositionAndId($position, $cId);
		
		if(!$candidate){
			$this->viewParams->formResult = "Candidate not found.";
			$this->showVotingPage();
		}
		else if($vote = Vote::create($this->voter, $candidate)){
			$this->vote = $vote;
			$this->showVotedPage();
		}
		else {
			$this->viewParams->formResult = "Vote not casted successfully";
			$this->showVotingPage();
		}		
	}
}