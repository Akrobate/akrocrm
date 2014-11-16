<?php

class Module_Edit extends CoreController {

	public function init() {
		
		$id = request::get('id');
		$fields = OrmNode::getFieldsFor($this->getModule());
		$data = array();
		$orm = new OrmNode();
		$content = $orm->getData($this->getModule(), $id);
		
		$data = OrmNode::dataFieldsAdapter($content, $fields, 'edit', 'rendered');		
			
		$this->assign('fields', $data);
		$this->assign('id', $id);
	}
}
