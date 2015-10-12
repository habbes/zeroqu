<?php

class Candidate extends DBModel
{
	
	protected $election_id;
	protected $position_id;
	protected $name;
	protected $description;
	protected $image_path;
	
	private $_election;
	private $_position;
	
	public function validate()
	{
		if(!$this->getElection()->isPending()){
			return false;
		}
		
		return true;
	}
	
	public function onDelete()
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
	
	public function setPosition(Position $position)
	{
		$this->position_id = $position->getId();
		$this->_position = $position;
	}
	
	public function getPosition()
	{
		if(!$this->_position){
			$this->_position = Position::findById($this->position_id);
		}
		return $this->_position;
	}
	
	public function getDir()
	{
		return $this->getElection()->getDir() . "/candidates/".$this->getId();
	}
	
	public function generateImagePath()
	{
		return $this->getDir() . "/image";
	}
	
	public function setImage($path){
		$imageStream = fopen($path, 'r+');
		$dest = $this->generateImagePath();
		Storage::instance()->putStream($dest, $imageStream);	
		fclose($imageStream);
		$this->image_path = $dest;
		$this->save();
	}
	
	public function getVotes()
	{
		return Vote::findByCandidate($this);
	}
	
	public function countVotes()
	{
		return Vote::countByCandidate($this);
	}
	
	public static function create(Position $position, $name)
	{
		$candidate = new self();
		$candidate->setPosition($position);
		$candidate->setElection($position->getElection());
		$candidate->setName($name);
		try {
			$candidate->save();
			return $candidate;
		}
		catch(PDOException $e){
			return false;
		}
	}
	
	public static function findByPosition(Position $position)
	{
		return static::findByField("position_id", $position->getId())->fetchAll();
	}
	
	public static function findByElection(Election $election)
	{
		return static::findByField("election_id", $election->getId())->fetchAll();
	}
	
	public static function findByElectionAndId(Election $election, $id)
	{
		return static::findOne("election_id=? AND id=?", [$election->getId(), $id]);
	}
	
	public static function findByPositionAndId(Position $position, $id)
	{
		return static::findOne("position_id=? AND id=?", [$position->getId(), $id]);
	}
	
	public static function countByPosition(Position $position)
	{
		return static::countByField("position_id", $position->getId());
	}
}