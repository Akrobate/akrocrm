<?php

class List_View extends CoreController {

	public function init() {
		$orm = new OrmNode();
		
		$listFields = $this->getListFields();
		$orm->setFilter($this->filter);
		$content = $orm->getAllDataWithJoins($this->getModule(), $listFields);

		
		$result = array();
	
		foreach($content as $cntk => $cnt) {
			$result[] = OrmNode::dataFieldsAdapter($cnt, $listFields, 'list', 'rendered');
		}
		$this->assign('datas', $result);		
	}
	
	
	public function getListFields() {
		$fields = OrmNode::getFieldsFor($this->getModule());
		$fields['id'] = "id";
		return $fields;		
	}



	public function setFilter($filter) {
		$this->filter = $filter;	
		
	}

	
}
