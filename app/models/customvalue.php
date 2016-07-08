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
    public function getProperty(){
        if(!$this->_property){
			$this->_property = CustomProperty::findById($this->customproperties_id);
		}
		return $this->_property;
    }
    public function getVoter(){
        if(!$this->_voter){
			$this->_voter = Voter::findById($this->voter_id);
		}
		return $this->_voter;
    }
}