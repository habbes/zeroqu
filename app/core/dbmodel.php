<?php

/**
 * maps objects to database entities
 * @author Habbes
 *
 */
class DBModel extends Model
{
	/* properties that are mapped to db columns are in snake case,
	 * they must match the table columns in order to fetch instances of the class directly through PDOStament methods
	 * properties that are not meant to be mapped to db columns begin with and underscore
	 */
	
	protected static $table;
	protected static $dbFields;

	
	protected $_inDb = false;
	
	protected $id = 0;
	
	protected static function database()
	{
		return Database::getInstance();
	}
	
	public static function table()
	{
		//TODO: find a way to cache the table name
		return Utils::camelToDelimitedCasePlural(get_called_class());
		
	}
	
	public function __construct($inDb = false)
	{
		$this->_inDb = $inDb;
	}
	
	/**
	 * gets the db id of this model
	 * @return number
	 */
	public function getId()
	{
		return $this->id;
	}
	
	
	/**
	 * checks whether this model and another are the same entity
	 * @param DBModel $other
	 * @return boolean
	 */
	public function is(DBModel $other)
	{
		return get_class($other) == get_called_class()
			 && $this->_inDb && $other->_inDb
			 && $this->id == $other->id;
	}
	
	/**
	 * whether this model in in the database
	 * @return boolean
	 */
	public function isInDb()
	{
		return $this->_inDb;
	}
	
	/**
	 * get the fields  database fields of this class
	 * @return array
	 */
	protected static function getDbFields()
	{
		//TODO: find a way to cache this value for the child class
		if(true){
			static::$dbFields = array();
			$class = new ReflectionClass(get_called_class());
			$properties = $class->getProperties();
			foreach($properties as $field){
				if($field->getName()[0] != "_" && !$field->isStatic())
					static::$dbFields[] = $field->getName();
			}
			
		}
		return static::$dbFields;
	}
	
	/**
	 * called whenever the model is saved to insure the data is valie
	 * if false is returned, the model will not be saved
	 * @return boolean
	 */
	protected function validate()
	{
		return true;
	}
	
	/**
	 * called before the model is inserted in the database
	 * if false is returned, the model will not be inserted in the database
	 * @return boolean
	 */
	protected function onInsert()
	{
		return true;
	}
	
	/**
	 * called before the model is updated in the database
	 * if false is returned, the model will not be updated
	 * @return boolean
	 */
	protected function onUpdate()
	{
		return true;
	}
	
	/**
	 * called before the model is deleted from the database
	 * if false is returned, the model will not be deleted
	 * @return boolean
	 */
	protected function onDelete()
	{
		return true;
	}
	
	/**
	 * inserts the model in the database
	 * @return boolean whether or not the insert succeeded
	 */
	protected function insert()
	{
		
		if(!$this->onInsert() || !$this->validate()){
			return false;
		}
		
		$q1 = "INSERT INTO ".static::table(). " (";
		$q2 = " VALUES (";
		$fields = static::getDbFields();
		$values = array();
		$count = count($fields);
		
		foreach($fields as $i=>$field){
			
			if($field == 'id'){
				continue;
			}
			$q1 .= "$field";
			$q2 .= "?";
			$values[] = $this->$field;
			if($i < $count - 2){
				$q1 .= ",";
				$q2 .= ",";
			}			
		}
		$q1 .= ")";
		$q2 .= ")";
		$query = $q1 . $q2;
		
		
		$stmt = self::database()->prepare($query);
		$result = $stmt->execute($values);
		
		if(!$result){
			return false;
		}
		
		$this->id = self::database()->lastInsertId();
		$this->_inDb = true;
		
		return true;
		
	}
	
	/**
	 * update the model in the database
	 * @return boolean whether or not the database succeeded
	 */
	protected function update()
	{
		if(!$this->onUpdate() || !$this->validate()){
			return false;
		}
		$fields = static::getDbFields();
		$query = "UPDATE " . static::table() . " SET";
		$values = array();
		$count = count($fields);
		foreach($fields as $i=>$field)
		{
			if($field == 'id'){
				continue;
			}
			$query .= " $field=?";
			if($i < $count - 2){
				$query .= ", ";
			}
			$values[] = $this->$field;
		}
		
		$query .= " WHERE id=?";
		$values[] = $this->id;
		
		$stmt = self::database()->prepare($query);
		$result = $stmt->execute($values);
		
		return $result;
		
	}
	
	/**
	 * delete the model from the database
	 * @return boolean whether or not the removal succeeded
	 */
	public function delete()
	{
		if(!$this->onDelete()){
			return false;
		}
		$query = "DELETE FROM " . static::table();
		$query .= " WHERE id=?";
		
		$stmt = self::database()->prepare($query);
		$result = $stmt->execute([$this->id]);
		
		return $result;
	}
	
	/**
	 * save the model in the database
	 * @return DBModel the saved model on success or false when save failed
	 */
	public function save()
	{
		if($this->_inDb){
			if($this->update())
			{
				return $this;
			}
		}
		else {
			$this->_inDb = $this->insert();
			if($this->_inDb){
				return $this;
			}
		}
		return false;
	}
	
	/**
	 * find models based on the query
	 * @param string $q the where clause part of the select query
	 * @param string $values values used to fill in the placeholder of the prepared query
	 * @param array $options options to specify things such as sorting, the size of the result set
	 * @return PDOStament used to fetch the result set and other info
	 */
	public static function find($q = "", array $values = null, array $options = array())
	{
		/*
		 * TODO: use options to set sorting, range of result set
		 */
		$query = "SELECT * FROM " . static::table();
		
		if($q){
			$query .= " WHERE " . $q;
		}
		
		
		if(!empty($values)){
			$stmt = self::database()->prepare($query);
			$stmt->execute($values);
		}
		else {
			$stmt = self::database()->query($query);
		}
		
		$obj = new static();
		$obj->_inDb = true;
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class(), array(true));
		
		return $stmt;
	}
	
	/**
	 * fetch at most one model based on the query
	 * @param string $q the where clause part of the select query
	 * @param string $values values used to fill in the placeholder of the prepared query
	 * @param array $options options to specify things such as sorting, the size of the result set
	 * @return DBModel
	 */
	public static function findOne($query = "", array $values = null, array $options = array())
	{
		//TODO: use stmt->fetch() instead
		$stmt = static::find($query, $values, $options);
		
		$res = $stmt->fetch();
		if(!$res){
			return null;
		}
		return $res;
	}
	
	/**
	 * fetch all models based on the query
	 * @param string $q the where clause part of the select query
	 * @param string $values values used to fill in the placeholder of the prepared query
	 * @param unknown $options options to specify things such as sorting, the size of the result set
	 * @return array(DBModel)
	 */
	public static function findAll($query = "", array $values = null, array $options = array())
	{
		return static::find($query, $values, $options)->fetchAll();
	}
	
	/**
	 * find models where the value of the specified field matches the one specified
	 * @param string $field
	 * @param mixed $value
	 * @param array $options options to specify things such as sorting, the size of the result set
	 * @return PDOStament used to fetch the result set and other info
	 */
	public static function findByField($field, $value, array $options = array())
	{
		$test = isset($options["test"])? $options["test"] : "=";
		return static::find("{$field}{$test}?",[$value], $options);
	}
	
	/**
	 * fetch all models where the value of the specified field matches the specified value
	 * @param string $field
	 * @param string $value
	 * @param param $options options to specify things such as sorting, the size of the result set
	 * @return array(DBModel)
	 */
	public static function findAllByField($field, $value, array $options = array())
	{
		return static::findByField($field, $value, $options)->fetchAll();
	}
	
	public static function findOneByField($field, $value, array $options = array())
	{
		return static::findByField($field, $value, $options)->fetch();
	}
	
	/**
	 * fetch model with the given id
	 * @param int $id
	 * @return DBModel
	 */
	public static function findById($id)
	{
		return static::findOne("id=?", [$id]);
	}
	
	/**
	 * fetch the first model based on the query
	 * @param string $query
	 * @param string $values
	 * @param array $options
	 * @return DBModel
	 */
	public static function findFirst($query = "", array $values = null, array $options=array())
	{
		return static::findOne($query, $values, $options);
	}
	
	/**
	 * fetch the last model based on the query
	 * @param string $query
	 * @param array $values
	 * @param array $options
	 * @return DBModel
	 */
	public static function findLast($query = "", array $values = null, array $options=array())
	{
		/**
		 * TODO: implement this method
		 */
		
	}
	
	/**
	 * counts the number of entries that match the given query
	 * @param string $q the where clause part of the query
	 * @param array $values values to bind to the placeholders in the query
	 * @param array $options additional options such as the column to count
	 * @return number
	 */
	public static function count($q = "", array $values = null, array $options=array())
	{
		$cols = isset($options['cols'])? $options['cols'] : "*";
		$query = "SELECT COUNT($cols) FROM " . static::table();
		if($query){
			$query .= " WHERE $q";
		}
		
		if(!empty($values)){
			$stmt = self::database()->prepare($query);
			$stmt->execute($values);
		}
		else {
			$stmt = self::database()->query($query);
		}
		
		return (int) $stmt->fetchColumn();
	}
	
	/**
	 * counts the number of entries where the given field has the give value
	 * @param string $field
	 * @param mixed $value
	 * @param array $options
	 * @return number
	 */
	public static function countByField($field, $value, $options = array())
	{
		return static::count("$field=?", [$value], $options);
	}
}