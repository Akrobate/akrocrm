<?php

class Modules_Messages_Edit extends CoreController {

	public function init() {
		
		$id = request::get('id');
		$fields = OrmNode::getFieldsFor($this->getModule());
		$data = array();
		
		if ($id != "") {
			$orm = new OrmNode();
			$content = $orm->getData($this->getModule(), $id);
			$data = OrmNode::dataFieldsAdapter($content, $fields, 'edit', 'rendered');		
		} else {
			$data = OrmNode::dataFieldsAdapterEmpty($fields, 'edit', 'rendered');
			$id=0;
		}
		
		$this->assign('fields', $data);
		$this->assign('id', $id);
	}
}
