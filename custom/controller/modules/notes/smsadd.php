<?php

class Module_Notes_Smsadd extends CoreController {

	public function init() {
	
		$id = request::get('id');


		$orm = new OrmNode();		
		$fields = OrmNode::getFieldsFor($this->getModule());		
		$data = array();
		/*
		foreach($fields as $fieldname=>$field) {
			$data[$fieldname] = request::get($fieldname);
		}*/
		
		$data['titre'] = request::get('phone');
		$data['description'] = request::get('text');
		
		$allFields = array_keys($fields);
		
		$rez = $orm->upsert($this->getModule(), $allFields, $data);	
		
		exit();
	}
}
