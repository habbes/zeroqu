<?php
class CustomValue extends DBModel
{
    protected static $table = "custom_values";

    protected $customproperty_id;
    protected $voter_id;
    protected $value;

    private $_voter;
    private $_property;

    public static function create(Voter $voter, CustomProperty $property, $value){
        $customValue = new self();
        $customValue->setCustomProperty($property);
        $customValue->setVoter($voter);
        $customValue->setValue($value);

        try{
            $customValue->save();
            return $customValue;
        }catch(PDOElection $e){
            return false;
        }
    }

    public function setCustomProperty($property){
        $this->customproperty_id = $property->id;
        $this->_property = $property;
    }
    public function setVoter($voter){
        $this->voter_id = $voter->id;
        $this->_voter = $voter;
    }
    public function setValue($value){
        $this->value = $value;
    }
    public function getValue(){
    	return $this->value;
    }
    public function getProperty(){
        if(!$this->_property){
			$this->_property = CustomProperty::findById($this->customproperty_id);
		}
		return $this->_property;
    }
    public function getVoter(){
        if(!$this->_voter){
			$this->_voter = Voter::findById($this->voter_id);
		}
		return $this->_voter;
    }
    
    public static function findByVoter($voter){
    	return static::findByField("voter_id", $voter->id)->fetchAll();
    }
    
    /**
     * 
     * @param Voter $voter
     * @param CustomProperty $property
     * @return CustomValue
     */
    public static function findByVoterAndProperty(Voter $voter, CustomProperty $property)
    {
    	$value = static::find('voter_id=? AND customproperty_id=?',
    			[$voter->getId(), $property->getId()])->fetch();
    	$value->_voter = $voter;
    	$value->_property = $property;
    	return $value;
    }
}