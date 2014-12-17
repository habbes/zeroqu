<?php

class Vote extends DBModel
{
	protected $election_id;
	protected $voter_id;
	protected $candidate_id;
	protected $position_id;
	
	private $_election;
	private $_voter;
	private $_candidate;
	private $_position;
	
	/**
	 * 
	 * @param Voter $voter
	 * @param Candidate $candidate
	 * @return Vote
	 */
	public static function create(Voter $voter, Candidate $candidate)
	{
		$vote = new self();
		$vote->setVoter($voter);
		$vote->setCandidate($candidate);
		$vote->setElection($voter->getElection());
		$vote->setPosition($candidate->getPosition());
		
		try {
			return $vote->save();
		}
		catch(PDOException $e){
			return null;
		}
		return null;
	}
	
	public function setElection(Election $election)
	{
		$this->election = $election;
		$this->election_id = $election->getId();
	}
	
	public function getElection()
	{
		if(!$this->_election){
			$this->_election = Election::findById($this->election_id);
		}
		return $this->_election;
	}
	
	public function setCandidate(Candidate $candidate)
	{
		$this->candidate = $candidate;
		$this->candidate_id = $candidate->getId();
	}
	
	public function getCandidate()
	{
		if(!$this->_candidate){
			$this->_candidate = Candidate::findById($this->candidate_id);
		}
		return $this->_candidate;
	}
	
	public function setPosition(Position $position)
	{
		$this->position = $position;
		$this->position_id = $position->getId();
	}
	
	public function getPosition()
	{
		if(!$this->_position){
			$this->_position = Position::findById($this->position_id);
		}
		return $this->_position;
	}
	
	public function setVoter(Voter $voter)
	{
		$this->voter = $voter;
		$this->voter_id = $voter->getId();
	}
	
	public function getVoter()
	{
		if(!$this->_voter){
			$this->_voter = Voter::findById($this->voter_id);
		}
		return $this->_voter;
	}
	
	protected function onUpdate()
	{
		return false;
	}
	
	protected function validate()
	{
		return $this->getVoter()->getElection()->is($this->getCandidate()->getElection());
	}
	
	public static function findByElection(Election $election)
	{
		return static::findByField("election_id", $election->getId())->fetchAll();
	}
	
	public static function findByPosition(Position $position)
	{
		return static::findByField("position_id", $position->getId())->fetchAll();
	}
	
	public static function findByCandidate(Candidate $candidate)
	{
		return static::findByField("candidate_id", $candidate->getId())->fetchAll();
	}
	
	public static function findByVoter(Voter $voter)
	{
		return static::findByField("voter_id", $voter->getId())->fetchAll();
	}
	
	public static function findByVoterAndPosition(Voter $voter, Position $position)
	{
		return static::findOne("voter_id=? AND position_id=?",[$voter->getId(), $position->getId()]);
	}
	
	public static function countByPosition(Position $position)
	{
		return static::countByField("position_id",$position->getId());
	}
	
	public static function countByCandidate(Candidate $candidate)
	{
		return static::countByField("candidate_id", $candidate->getId());
	}
	
	
}