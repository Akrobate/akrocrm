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
		
		if ($id != "") {
			$allFields[] = 'id';
			$data['id'] = $id;
		}
		

		$rez = $orm->upsert($this->getModule(), $allFields, $data);	
//		print_r($rez);
		
		if ($rez['id'] != 0) {
			$id = $rez['id'];
		}

		//echo("========" . $id);
		url::redirect($this->getModule(), 'view', $id);	
		
	}
}
