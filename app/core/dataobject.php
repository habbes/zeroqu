<?php

/**
 * a dynamic object for holding arbitrary data
 * @author Habbes
 *
 */
class DataObject
{
	protected $data;
	
	public function __construct($data = null)
	{
		$this->data = array();
		if(gettype($data) == "array"){
			foreach($data as $key=>$value){
				$this->data[$key] = $value;
			}
		}
	}
	
	/**
	 * retrieve a property
	 * @param string $name data to retrive
	 * @param unknown $default the value returned when the specified property does not exist
	 * @return mixed
	 */
	public function get($name, $default = null)
	{
		if(array_key_exists($name, $this->data))
			return $this->data[$name];
		return $default;
	}
	
	/**
	 * add data to the object
	 * @param string $name
	 * @param mixed $value
	 */
	public function set($name, $value)
	{
		$this->data[$name] = $value;
	}
	
	public function __get($name)
	{
		return $this->get($name);
	}
	
	public function __set($name, $value)
	{
		return $this->set($name, $value);
	}
	
	public function __unset($name){
		unset($this->data[$name]);
	}
}