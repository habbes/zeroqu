<?php

abstract class BaseRuleType {
	
	const RULE_PROPERTYEQ = 'propertyEq';
	
	abstract public function toDict();
	public static abstract function createFromDict($obj);
}