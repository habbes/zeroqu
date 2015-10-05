<?php

class Election extends DBModel
{
	
	
	
	protected $admin_id;
	protected $name;
	protected $title;
	protected $status;
	protected $start_date;
	protected $end_date;
	
	private $_admin;
	
	const PENDING = 1;
	const ONGOING = 2;
	const ENDED = 3;
	
	public static function create($admin, $name, $title)
	{
		$election = new self();
		$election->setAdmin($admin);
		$election->setName($name);
		$election->setTitle($title);
		$election->setStatus(self::PENDING);
		
		try{
			$election->save();
			return $election;
		}
		catch (PDOException $e){
			return false;
		}
	}
	
	public function setAdmin(Admin $admin)
	{
		if($this->_inDb){
			return false;
		}
		$this->admin_id = $admin->getId();
		$this->_admin = $admin;
	}
	
	public function getAdmin()
	{
		if(!$this->_admin){
			$this->_admin = Admin::findById($this->admin_id);
		}
		return $this->_admin;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getStartDate()
	{
		return strtotime($this->start_date);
	}
	
	public function setStartDate($date)
	{
		$this->start_date = Utils::dbDateFormat($date);
	}
	
	public function getEndDate()
	{
		return strtotime($this->end_date);
	}
	
	public function setEndDate($date)
	{
		$this->end_date = Utils::dbDateFormat($date);
	}
	
	public function isOngoing()
	{
		return $this->getStatus() == self::ONGOING;
	}
	
	public function isPending()
	{
		return $this->getStatus() == self::PENDING;
	}
	
	public function hasEnded()
	{
		return $this->getStatus() == self::ENDED;
	}
	
	public function start()
	{
		$this->setStatus(self::ONGOING);
		return $this->save();
	}
	
	public function end()
	{
		$this->setStatus(self::ENDED);
		return $this->save();
	}
	
	public function validate()
	{
		if(!$this->title || !$this->name || !$this->admin_id){
			return false;
		}
		
		return true;
	}
	
	
	public function getPositions()
	{
		return Position::findByElection($this);
	}
	
	public function getPositionById($id)
	{
		return Position::findByElectionAndId($this, $id);
	}
	
	public function getCandidates()
	{
		return Candidate::findByElection($this);
	}
	
	public function getCandidateById($id)
	{
		return Candidate::findByElectionAndId($this, $id);
	}
	
	public function getVoters()
	{
		return Voter::findByElection($this);
	}
	
	public function getVoterById($id)
	{
		return Voter::findByElectionAndId($this, $id);
	}
	
	public function getVotes()
	{
		return Vote::findByElection($this);
	}
	
	public function addVoters(array $emails, EmailView $emailView)
	{
		foreach($emails as $email){
			$email = trim($email);
			if(!$email) continue;
			Voter::create($this, $email, $emailView);
		}
		
		try {
			$this->save();
		}
		catch (PDOException $e){
			return false;
		}
	}
	
	public static function findByAdmin(Admin $admin)
	{
		return static::findByField("admin_id", $admin->getId())->fetchAll();
	}
	
	public static function findByName($name)
	{
		return static::findByField("name", $name)->fetch();
	}
	
	public static function findByAdminAndName(Admin $admin, $name)
	{
		return static::findOne("admin_id=? AND name=?", [$admin->getId(), $name]);
	}
}