<?php


class Fields extends CoreController{

	public $name;
	public $value;
	public $label;
	
	
	
	public function setValue($value) {
		$this->value = $value;	
	}
	
	
	public function setName($name) {
		$this->name = $name;	
	}


	public function setLabel($label) {
		$this->label = $label;	
	}

	public function getName() {
		return $this->name;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getValue() {
		return $this->value;
	}
	
	public function init(){
	
		$nameJoin = $this->isJoin();
	
	
	}
	
	public function isJoin() {
		
		$obj = new OrmNode();
		$obj->getAllObj();
		
		
		
		$explode = explode("_", $this->getName);
		$nb_exoplode = count($explode);
		if ($nb_exoplode > 1) {
			/*foreach($explode as $ex) {
				if ($ex == "id") {
					sql::tableExists();		
				} else if (in_array($ex, sql::tableExists($ex))) { // ne foctonne pas c sur
					
				}
				
			}		*/	
				
				
			if ($explode[0] == 'id' && in_array($explode[1], $mudules)) {
			
			}			
		}
		
		
		
	}
	
	
	

}
