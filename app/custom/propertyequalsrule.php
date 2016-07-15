<?php

class PropertyEqualsRule extends BaseRuleType {
	
	const RULE_KEY =  static::RULE_PROPERTYEQ;
	
	
	public $property_id;
	
	/**
	 * 
	 * @var string
	 */
	public $value;
	
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