<?php

class Election extends DBModel
{
	
	
	protected $org_id;
	protected $admin_id;
	protected $name;
	protected $title;
	protected $status;
	protected $start_date;
	protected $end_date;
	protected $results_released;
	
	private $_admin;
	private $_org;
	
	const PENDING = 1;
	const ONGOING = 2;
	const ENDED = 3;
	
	public static function create($org, $admin, $name, $title)
	{
		$election = new self();
		$election->setOrg($org);
		$election->setAdmin($admin);
		$election->setName($name);
		$election->setTitle($title);
		$election->setStatus(self::PENDING);
		$election->results_released = (int) false;
		
		try{
			$election->save();
			return $election;
		}
		catch (PDOException $e){
			return false;
		}
	}
	
	public function setOrg(Org $org)
	{
		if($this->_inDb){
			return false;
		}
		$this->org_id = $org->getId();
		$this->_org = $org;
	}
	
	public function getOrg()
	{
		if(!$this->_org){
			$this->_org = Org::findById($this->org_id);
		}
		return $this->_org;
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
	
	public function areResultsReleased()
	{
		return (bool) $this->results_released;
	}
	
	public function releaseResults()
	{
		$this->results_released = (int) true;
		return $this->save();
	}
	
	/**
	 * the election's directory
	 * @return string
	 */
	public function getDir()
	{
		return $this->getOrg()->getDir()."/elections/".$this->getName();
	}
	
	public function validate()
	{
		if(!$this->title || !$this->name || !$this->admin_id){
			return false;
		}
		
		return true;
	}
	
	/**
	 * @return array
	 */
	public function getPositions()
	{
		return Position::findByElection($this);
	}
	
	/**
	 * 
	 * @param unknown $id
	 * @return Position
	 */
	public function getPositionById($id)
	{
		return Position::findByElectionAndId($this, $id);
	}
	
	/**
	 * @return array
	 */
	public function getCandidates()
	{
		return Candidate::findByElection($this);
	}
	
	/**
	 * 
	 * @param unknown $id
	 * @return Candidate
	 */
	public function getCandidateById($id)
	{
		return Candidate::findByElectionAndId($this, $id);
	}
	
	public function getVoters()
	{
		return Voter::findByElection($this);
	}
	
	/**
	 * Find voters in this election that match the specified query
	 * @param string $q
	 * @param array $params
	 * @param string $range part of query specifying LIMIT and OFFSET
	 */
	public function getVotersWhere($q = '', $params = [], $range = '')
	{
		return Voter::findByElectionWhere($this, $q, $params, $range);
	}
	
	public function getVoterById($id)
	{
		return Voter::findByElectionAndId($this, $id);
	}
	
	public function getVotes()
	{
		return Vote::findByElection($this);
	}
	
	public function addVoters(array $emails, $voterProperties, EmailView $emailView)
	{
		foreach($emails as $email){
			$email = trim($email);
			if(!$email) continue;
			$voter = Voter::create($this, $email, $emailView);

			if($voter){
				foreach($voterProperties as $key=>$value){
					$property = $this->getPropertyByName($key);
					$voter->setCustomValue($property, $value);
				}
			}else{
				return false;
			}
		}
		
		try {
			$this->save();
		}
		catch (PDOException $e){
			return false;
		}
	}
	
	public static function findByOrg(Org $org)
	{
		return static::findByField('org_id', $org->getId())->fetchAll();
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
	/*
	Creates a custom property of this election
	@param String $name
	@param String type default 'text'
	**/
	public function createCustomProperty($name, $type= 'text'){
		return CustomProperty::create($this, $name, $type);
	}
	/*
	Gets all custom properties
	@return array
	*/
	public function getCustomProperties(){
		return CustomProperty::findByElection($this);
	}
	
	/**
	 * gets custom property of this election by id
	 * @param unknown $id
	 * @return CustomProperty
	 */
	public function getPropertyById($id){
		return CustomProperty::findOne('id=? AND election_id=?', 
				[$id, $this->getId()]);
	}
	
	/**
	 * gets custom property this election by by name
	 * @param string $name
	 * @return CustomProperty
	 */
	public function getPropertyByName($name){
		return CustomProperty::findOne("name=? AND election_id=?", 
				[$name, $this->getId()]);
	}
}