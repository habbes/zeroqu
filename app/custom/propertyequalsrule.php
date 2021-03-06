<?php

class PropertyEqualsRule extends BaseRuleType {
	
	
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
	
	public function getDisplayText()
	{
		$property = CustomProperty::findById($this->property_id);
		$text = "{$property->getName()} must be {$this->value}";
		return $text;
	}
	
	public function toDict(){
		$obj = [
			'propertyId'=>$this->property_id,
			'value' => $this->value				
		];
		return $obj;
	}
	
	public static function getRuleKey(){
		return static::RULE_PROPERTYEQ;
	}
	
	public static function createFromDict($obj){
		$rule = new self();
		$rule->property_id = (int) $obj['propertyId'];
		$rule->value = (int) $obj['value'];
		return $rule;
	}
}