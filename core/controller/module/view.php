<?php

	class Module_View extends CoreController {

		public function init() {
	
			$id = request::get('id');
			$fields = OrmNode::getFieldsFor($this->getModule());
			$data = array();
			$orm = new OrmNode();
			$content = $orm->getData($this->getModule(), $id);

			$this->autoloadTemplate();


			foreach($fields as $fieldname=>$field) {
				if ($field['type'] == 'text') {
					unset($obj);
					$obj = new Field_Text();
					$obj->setAction('view');
					$obj->setValue($content[$fieldname]);
					$obj->setName($fieldname);
					$obj->setLabel($field['label']);
					$data[] = $obj->renderSTR();
				}	
			}
			$this->assign('fields', $data);
		}
	}
