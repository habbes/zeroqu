<?php

class Position extends DBModel
{
	protected $election_id;
	protected $title;
	protected $description;
	
	private $_election;
	
	public static function create(Election $election, $title, $description)
	{
		$position = new self();
		$position->setElection($election);
		$position->setTitle($title);
		$position->setDescription($description);
		try {
			$position->save();
			return $position;
		}
		catch(PDOException $e){
			return false;
		}
	}
	
	public function validate()
	{
		if(!$this->getElection()->isPending()){
			return false;
		}
		
		return true;
	}
	
	public function onRemove()
	{
		if(!$this->getElection()->isPending()){
			return false;
		}
	
		return true;
	}
	
	public function setElection(Election $election)
	{
		if($this->_inDb){
			return false;
		}
		$this->election_id = $election->getId();
		$this->_election = $election;
	}
	
	public function getElection()
	{
		if(!$this->_election){
			$this->_election = Election::findById($this->election_id);
		}
		return $this->_election;
	}
	
	public function getCandidates()
	{
		return Candidate::findByPosition($this);
	}
	
	public function countCandidates()
	{
		return Candidate::countByPosition($this);
	}
	
	public function getVotes()
	{
		return Vote::findByPosition($this);
	}
	
	public function countVotes()
	{
		return Vote::countByPosition($this);
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getCustomRules()
	{
		return CustomRule::findByPosition($this);
	}
	
	/**
	 * 
	 * @param int $id
	 * @return CustomRule
	 */
	public function getCustomRuleById($id)
	{
		return CustomRule::findByPositionAndId($this, $id);
	}
	
	/**
	 * 
	 * @param BaseRuleType $rule
	 * @param string $name
	 * @return CustomRule
	 */
	public function createCustomRule(BaseRuleType $rule, $name)
	{
		return CustomRule::create($this, $rule, $name);
	}

	/**
	 * check whether voter is eligible to cast vote in
	 * this position
	 * @param Voter $voter
	 * @return boolean
	 */
	public function isVoterEligible(Voter $voter){
		return $this->matchRules($voter);
	}
	
	/**
	 * check whether voter matches all rules for the given position
	 * @param Voter $voter
	 * @return boolean
	 */
	public function matchRules(Voter $voter){
		$rules = $this->getCustomRules();
		foreach($rules as $rule){
			if(!$rule->match($voter)){
				return false;
			}
		}
		return true;
	}
	
	public static function findByElection(Election $election)
	{
		return  static::findByField("election_id", $election->getId())->fetchAll();
	}
	
	public static function findByElectionAndId(Election $election, $id)
	{
		return static::findOne("election_id=? AND id=?", [$election->getId(), (int) $id]);
	}
	
	/**
	 * @param Election $election
	 * @param string $title
	 * @return Position
	 */
	public static function findByElectionAndTitle(Election $election,$title)
	{
		return static::findOne("election_id=? AND title=?", [$election->getId(), $title]);
	}
	
}