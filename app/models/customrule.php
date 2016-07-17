<?php

class CustomRule extends DBModel
{
	protected $name;
	protected $rule;
	protected $position_id;
	
	private $_position;
	
	/**
	 * create custom rule for the given position
	 * @param Position $position
	 * @param BaseRuleType $rule
	 * @return DBModel
	 */
	public static function create(Position $position, BaseRuleType $rule)
	{
		$r = new self();
		$r->_position = $position;
		$r->position_id = $position->getId();
		$r->rule = $rule->toJson();
		return $r->save();
	}
	
	public function getPosition()
	{
		if(!$this->_position){
			$this->_position = Position::findById($this->position_id);
		}
		return $this->_position;
	}
	
	public function validate(){
		// allow modification only if position allows modification
		return $this->getPosition()->validate();
	}
	
	
	/**
	 * 
	 * @param BaseRuleType $rule
	 */
	public function setRule(BaseRuleType $rule){
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
	 * check whether this rule applies to specified voter
	 * @param Voter $voter
	 * @return boolean
	 */
	public function match(Voter $voter){
		return $this->getRule()->match($voter);
	}
	
	/**
	 * find custom rules for the given position
	 * @param Position $position
	 * @return array
	 */
	public static function findByPosition(Position $position){
		return static::findByField('position_id', $position->getId());
	}
	
	
}