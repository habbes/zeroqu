<?php

class CustomRule extends DBModel
{
	protected $name;
	protected $rule;
	protected $position_id;
	
	private $_position;
	private $_election;
	
	/**
	 * create custom rule for the given position
	 * @param Position $position
	 * @param BaseRuleType $rule
	 * @param string $name
	 * @return DBModel
	 */
	public static function create(Position $position, BaseRuleType $rule, $name)
	{
		$r = new self();
		$r->_position = $position;
		$r->position_id = $position->getId();
		$r->rule = $rule->toJson();
		$r->name = $name;
		return $r->save();
	}
	
	/**
	 * 
	 * @return Position
	 */
	public function getPosition()
	{
		if(!$this->_position){
			$this->_position = Position::findById($this->position_id);
		}
		return $this->_position;
	}
	
	/**
	 * @return Election
	 */
	public function getElection()
	{
		if(!$this->_election){
			$this->_election = $this->getPosition()->getElection();
		}	
		return $this->_election;
	}
	
	public function validate()
	{
		// allow modification only if position allows modification
		return $this->getPosition()->validate();
	}
	
	
	public function onDelete()
	{
		if(!$this->getElection()->isPending()){
			return false;
		}
		return true;
	}
	
	/**
	 * 
	 * @param BaseRuleType $rule
	 */
	public function setRule(BaseRuleType $rule)
	{
		$this->rule = $rule->toJson();
	}
	
	
	/**
	 * 
	 * @return BaseRuleType
	 */
	public function getRule()
	{
		return BaseRuleType::fromJson($this->rule);
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getDisplayText()
	{
		return $this->getRule()->getDisplayText();
	}
	
	/**
	 * check whether this rule applies to specified voter
	 * @param Voter $voter
	 * @return boolean
	 */
	public function match(Voter $voter)
	{
		return $this->getRule()->match($voter);
	}
	
	/**
	 * find custom rules for the given position
	 * @param Position $position
	 * @return array
	 */
	public static function findByPosition(Position $position)
	{
		return static::findByField('position_id', $position->getId())->fetchAll();
	}
	
	/**
	 * 
	 * @param Position $position
	 * @param int $id
	 * @return CustomRule
	 */
	public static function findByPositionAndId(Position $position, $id)
	{
		return static::findOne('position_id=? AND id=?', 
				[$position->getId(), $id]);
	}
	
	
}