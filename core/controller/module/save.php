<?php

class Module_Save extends CoreController {

	public function init() {
	
		$id = request::get('id');
		$orm = new OrmNode();		
		$fields = OrmNode::getFieldsFor($this->getModule());
		
		$data = array();

		foreach($fields as $fieldname=>$field) {
			$data[$fieldname] = request::get($fieldname);
		}
		
		$allFields = array_keys($fields);
		$allFields[] = 'id';
		$data['id'] = $id;
		
		$rez = $orm->upsert($this->getModule(), $allFields, $data);	
		
		url::redirect($this->getModule(), 'view', $id);	
	}
}
