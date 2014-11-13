<?php

class Save extends CoreController {

	public function __construct() {
		$this->template = "core/views/edit.php";
	}

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
		$content = $orm->getData($this->getModule(), $id);
		
		$data = array();
		
		foreach($fields as $fieldname=>$field) {
		
			if ($field['type'] == 'text') {
			
				unset($obj);
				$obj = new FieldText();
				$obj->setAction('edit');
				$obj->setValue($content[$fieldname]);
				$obj->setName($fieldname);
				$obj->setLabel($field['label']);
				$data[] = $obj->renderSTR();
				
			}
			
		}

		$this->assign('fields', $data);
		$this->assign('id', $id);
	}
}
