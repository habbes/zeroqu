<?php

abstract class BaseRuleType {
	
	const RULE_PROPERTYEQ = 'propertyEq';
	
	/**
	 * check whether the given voter matches this rule
	 * @param Voter $voter
	 * @return boolean
	 */
	abstract public function match(Voter $voter);
	
	/**
	 * friendly display text describing the rule
	 * @return string
	 */
	abstract public function getDisplayText();
	
	/**
	 * @return string
	 */
	abstract static public function getRuleKey();
	
	/**
	 * serialize rule to dictionary
	 */
	abstract public function toDict();
	
	/**
	 * deserialize rule from dictionary
	 * @param array $obj
	 */
	abstract static public function createFromDict($obj);
	
	/**
	 * discover rule type and deserialize from dictionary
	 * @param array $obj
	 * @return BaseRuleType
	 */
	public static function createTypeFromDict($obj){
		$name = array_keys($obj)[0];
		switch($name){
			case self::RULE_PROPERTYEQ:
				$rule = $obj[$name];
				return PropertyEqualsRule::createFromDict($rule);
			
		}
		return false;
	}
	
	/**
	 * deserialize rule from json string
	 * @param string $json
	 * @return boolean
	 */
	public static function fromJson($json){
		$dict = json_decode($json, true);
		$rule = static::createTypeFromDict($dict);
		return $rule;
	}
	
	/**
	 * serialize rule to json string
	 * @return string $json
	 */
	public function toJson(){
		$obj = [
				static::getRuleKey() => $this->toDict()
		];
		return json_encode($obj);
	}
}