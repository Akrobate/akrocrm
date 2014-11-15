<?php

class Module_Index extends CoreController {

	public function init() {
	
		$id = request::get('id');
		$modules = $this->getModule();

		$fields = OrmNode::getFieldsFor($this->getModule());	
		
		$data = array();
		$orm = new OrmNode();
		$fields['id']['type'] = "int";
		$content = $orm->getAllData($this->getModule(), $fields);
		
		$this->assign('datas', $content);
	}
}
