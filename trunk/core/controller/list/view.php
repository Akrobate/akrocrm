<?php

class List_View extends CoreController {

	public $start;
	public $nbr;
	public $total;

	public function __construct() {
		parent::__construct();
		$this->start = 0;
		$this->nbr = 10;
	}


	public function init() {
		$orm = new OrmNode();
		
		$orm->start_limit = $this->start;
		$orm->nbr_limit = $this->nbr;		
		
		$listFields = $this->getListFields();
		
		$orm->setFilter($this->filter);
		$content = $orm->getAllDataWithJoins($this->getModule(), $listFields);
		
		$this->total = $orm->total;
		
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
	
	
	public function setStart($start) {
		$this->start = $start;
	}
	
	public function setNbr($nbr) {
		$this->nbr = $nbr;
	}
	
	
	
}
