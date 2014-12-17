<?php

/**
 * Base Model class
 * @author Habbes
 *
 */
abstract class Model
{
	//dynamic getter and setter
	public function __call($method, $args)
	{
		$property = Utils::camelToDelimitedCase(substr($method, 3));
		$type = substr($method, 0, 3);
		if($type == "get"){
	
		return $this->$property;
			
		}
		else if($type == "set"){
			$this->$property = $args[0];
		}
	}
	
}