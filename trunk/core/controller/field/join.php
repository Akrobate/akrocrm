<?php

/**
 *	classe qui gere les champs de type jointure
 *	
 *	@brief	Gestion des jointures
 *	
 *	@author	Artiom FEDOROV
 *	@date	19/12/2014
 */

class Field_Join extends Field {

	public $moduletojoin;
	public $fieldtoshow;
	public $joinid;

	
	/**
	 *	Surcharge de l'initialisation
	 *
	 */
	
	public function init() {
		parent::init();
		$this->joinid = $this->value['id'];
		$this->joinfieldvalue = $this->value[$this->fieldtoshow];
	}


	/**
	 *	@brief	setteur de tous le parametres de champs
	 *	@param	fieldname	Nom du champ
	 *	@papam	params		Tous le parametres comme decrits dans fields.php
	 *	@return	this
	 */
	
	public function setAllFieldsParams($fieldname, $params) {
		parent::setAllFieldsParams($fieldname, $params);
		$this->setJoinToModule($params['join']['table']);
		$this->setVisibleField($params['join']['field']);
		return $this;
	}
	
	
	/**
	 *	@brief	setteur du module a joindre
	 *	@param	module	Module a joindre
	 *	@return	this
	 */
	
	public function setJoinToModule($module) {
		$this->moduletojoin = $module;
		return $this;
	}
	
	
	/**
	 *	@brief	setteur de champ a rendre
	 *	@param	field	Nom du champ a afficher
	 *	@return	this
	 */
	 
	public function setVisibleField($field) {
		$this->fieldtoshow = $field;
		return $this;		
	}
	
	
	/**
	 *	@brief	setteur d'id de la jointure
	 *	@param	id	id de la jointure
	 *	@return	this	 
	 */
	public function setJoinId($id) {
		$this->joinid = $id;
		return $this;
	}



}
