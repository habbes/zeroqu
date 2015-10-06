<?php

class Voter extends DBModel
{
	
	protected $voter_id;
	protected $password;
	protected $election_id;
	protected $email;
	protected $status;
	
	private $_election;
	
	const EMAIL_FAILED = 1;
	const EMAIL_SENT = 2;
	const REGISTERED = 3;
	
	public static function create(Election $election, $email, EmailView $emailView)
	{
		$voter = new self();
		$voter->setElection($election);
		$voter->setVoterId($email);
		$voter->setEmail($email);
		$voter->status = self::EMAIL_FAILED;
		
		try {
			$voter->save();
			$voter->sendEmail($emailView);
			return $voter;
		}
		catch(PDOException $e){
			return false;
		}
	}
	
	/**
	 * generates a random password and stores its hash
	 * @return string unhashed password
	 */
	protected function generatePassword()
	{
		$pass = str_shuffle(uniqid());
		$length = rand(5,8);
		$offset = rand(0, 5);
		$pass = substr($pass, $offset, $length);
		$this->setPassword($pass);
		return $pass;
	}
	
	public function setVoterId($voterid)
	{
		if($this->_inDb){
			return false;
		}
		$this->voter_id = $voterid;
	}
	
	protected function setPassword($password)
	{
		
		$this->password = Utils::hashPassword($password);
	}
	
	public function verifyPassword($password)
	{
		return Utils::verifyPassword($password, $this->password);
	}
	
	public function changePassword($new, $old)
	{
		if($this->verifyPassword($old)){
			$this->password = Utils::hashPassword($password);
			return true;
		}
		return false;
	}
	
	public function getStatus()
	{
		return (int) $this->status;
	}
	
	public function isStatus($status){
		return $this->getStatus() == $status;
	}
	
	public function isEmailFailed()
	{
		return $this->isStatus(self::EMAIL_FAILED);
	}
	
	public function isEmailSent()
	{
		return $this->isStatus(self::EMAIL_SENT) || $this->isStatus(self::REGISTERED);
	}
	
	public function isRegistered()
	{
		return $this->isStatus(self::REGISTERED);
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
	
	public function sendEmail(EmailView $emailView)
	{
		$pass = $this->generatePassword();
		
		try{
			$this->save();
			$params = new DataObject(["org"=>$this->getElection()->getOrg(), "election"=>$this->getElection(),"voterId"=>$this->voter_id,"voterPass"=>$pass]);
			$result = Mailer::sendHtml($this->email,null, "Voter Login Details", $emailView->renderEmail($params));
			if($result){
				
				$this->status = self::EMAIL_SENT;
				$this->save();
				return true;
			}
			else {
				$this->status = self::EMAIL_FAILED;
				$this->save();
			}
			return false;
			
		}
		catch(PDOException $e){
			return false;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	public static function login($voterId, $electionName, $password)
	{
		
		$voter = static::findOne("voter_id=? AND election_id=(SELECT id FROM ".Election::table()." WHERE name=?)",[$voterId, $electionName]);
		
		if($voter && $voter->verifyPassword($password)){
			if($voter->status != self::REGISTERED){
				$voter->status = self::REGISTERED;
				$voter->save();
			}
			return $voter;
		}
		return false;
	}
	
	
	public function getVotes()
	{
		return Vote::findByVoter($this);
	}
	
	public function getVoteByPosition($position)
	{
		return Vote::findByVoterAndPosition($this, $position);
	}
	
	public function vote(Candidate $candidate)
	{
		$vote = new Vote();
		$vote->setVoter($this);
		$vote->setCandidate($candidate);
		$vote->setPosition($candidate->getPosition());
		$vote->setElection($this->getElection());
		
		return $vote->save();
	}
	
	protected function validate()
	{
		if(!$this->getElection()->isPending()){
			return false;
		}
		
		return true;
	}
	
	protected function onDelete(){
		if(!$this->getElection()->isPending()){
			return false;
		}
		
		return true;
	}
	
	public static function findByElection(Election $election)
	{
		return static::findByField("election_id", $election->getId())->fetchAll();
	}
	
	public static function findByElectionAndId(Election $election, $id)
	{
		return static::findOne("id=? AND election_id=?",[$id, $election->getId()]);
	}
	
}