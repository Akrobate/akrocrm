<?php

class Module_Edit extends CoreController {

	public function init() {
		
		$id = request::get('id');
		$fields = OrmNode::getFieldsFor($this->getModule());
		$data = array();
		$orm = new OrmNode();
		$content = $orm->getData($this->getModule(), $id);

		// creation de tous les objets
		foreach($fields as $fieldname=>$field) {
			if ($field['type'] == 'text' || $field['type'] == 'join') {
				unset($obj);
				$obj = new Field_Text();
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
