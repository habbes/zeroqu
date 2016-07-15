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
	
	/**
	 * 
	 * @return BaseRuleType
	 */
	public function deserializeRule()
	{
		return BaseRuleType::fromJson($this->rule);
	}
	
	
}