<?php

/**
 *	Classe qui controlle les champs de manière generique
 *	Cette classe est un extends pour les types de champs 
 *	Particuliers comme dans le dossier ./fields
 *
 *	@author Artiom FEDOROV
 *	@date 2014
 *
 */

class Field extends CoreController{

	public $name;
	public $value;
	public $label;	
	
	public $field_params;
	
	public function setValue($value) {
		$this->value = $value;	
	}
	
	public function setName($name) {
		$this->name = $name;	
	}

	public function setLabel($label) {
		$this->label = $label;	
	}

	public function setAllFieldsParams($fieldname, $params) {
		$this->field_params = $params;
		$this->setName($fieldname);
		$this->setLabel($params['label']);
	
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
	
	public function init() {
		$this->autoloadTemplateField();
	}
	
	
	/**
	 *	Methode permettant de réaliser l'autoload du template
	 *	du champ initialisé
	 *
	 */
	
	
	public function autoloadTemplateField() {
		$classname = get_class($this);
		$exp = explode("_", strtolower($classname));
		$str = implode("/", $exp);
		$action = $this->action;
		$this->template = PATH_CORE_VIEWS . $str . '/' . $action . ".php";
	}

	
	/* @TODO Non finalisé */
	
	public function isJoin() {
		
		$obj = new OrmNode();
		$obj->getAllObj();
		$explode = explode("_", $this->getName);		
		$nb_exoplode = count($explode);
		if ($nb_exoplode > 1) {
		
			if ($explode[0] == 'id' && in_array($explode[1], $mudules)) {
			
			}			
		}
		
	}
	
}
