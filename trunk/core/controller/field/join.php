<?php

class Field_Join extends Field {

	public $moduletojoin;
	public $fieldtoshow;
	public $joinid;
	
	
	public function init() {
		parent::init();
		$this->joinid = $this->value['id'];
		$this->joinfieldvalue = $this->value[$this->fieldtoshow];
	}

	public function setAllFieldsParams($fieldname, $params) {
		parent::setAllFieldsParams($fieldname, $params);

		$this->setJoinToModule($params['join']['table']);
		$this->setVisibleField($params['join']['field']);

	}
	
	
	
	public function setJoinToModule($module) {
		$this->moduletojoin = $module;
	}
	

	public function setVisibleField($field) {
		$this->fieldtoshow = $field;
	}
	
	
	public function setJoinId($id) {
		$this->joinid = $id;
	}



}
