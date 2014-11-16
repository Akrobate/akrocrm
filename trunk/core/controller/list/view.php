<?php

class List_View extends CoreController {

	public function init() {
		$orm = new OrmNode();		
		
		$listFields = $this->getListFields();
		
		$content = $orm->getAllData($this->getModule(), $listFields);	
	
		$result = array();
	
		foreach($content as $cntk => $cnt) {
			$tmp = OrmNode::dataFieldsAdapter($cnt, $listFields, 'list', 'rendered');
			$result[] = $tmp;
		}
		$this->assign('datas', $result);		
	}
	
	
	public function getListFields() {
		$fields = OrmNode::getFieldsFor($this->getModule());
		$fields['id'] = "id";
		return $fields;		
	}
	
	
//	public function 
	
	
	
	
}
