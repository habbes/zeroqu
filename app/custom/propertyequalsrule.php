<?php

class PropertyEqualsRule extends BaseRuleType {
	
	const RULE_KEY =  static::RULE_PROPERTYEQ;
	
	
	public $property_id;
	
	/**
	 * 
	 * @var string
	 */
	public $value;
	
	
	public function match(Voter $voter){
		// check whether voter's value for custom property
		// matches the rule's value for that property
		$election = $voter->getElection();
		$property = $election->getPropertyById($this->property_id);
		$value = $voter->getCustomValue($property);
		return $value->getValue() == $this->value;
	}
	
	public function toDict(){
		$obj = [
			'propertyId'=>$this->property_id,
			'value' => $this->value				
		];
		return $obj;
	}
	
	public static function createFromDict($obj){
		$rule = new self();
		$rule->property_id = (int) $obj['propertyId'];
		$rule->value = (int) $obj['value'];
	}
}