<?php

class Index extends CoreController {

	public function __construct() {
		$this->template = "core/views/index.php";
	}

	public function init() {
	
		$id = request::get('id');
		$modules = $this->getModule();

		$fields = OrmNode::getFieldsFor($this->getModule());	
		
		print_r ($fields);
		
		$data = array();
		$orm = new OrmNode();
		$fields['id']['type'] = "int";
		$content = $orm->getAllData($this->getModule(), $fields);
		
		
		//$this->assign('data', $fields);
		$this->assign('datas', $content);
	}
}
