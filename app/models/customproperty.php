<?php
class CustomProperty extends DBModel{
    protected static $table = "custom_properties";

    protected $election_id;
    public $name;
    public $type;

    private $_election;

    public static function create(Election $election, $name, $type){
        $property = new self();
        $property->name = $name;
        $property->type = $type;
        $property->setElection($election);

        try{
            $property->save();
            return $property;
        }catch(PDOEsception $e){
            return false;
        }
    }
    public function setElection($election){
        $this->election_id = $election->id;
		$this->_election = Election::findById($this->election_id);
    }
    public function getElection(){
        if(!$this->_election){
			$this->_election = Election::findById($this->election_id);
		}
		return $this->_election;
    }
    public static function findByElection($election){
       $election_id = $election->id;
       return static::findByField('election_id', $election_id)->fetchAll();
    }
}