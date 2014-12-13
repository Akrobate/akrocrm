<?php

class Modules_Messages_Smsadd extends CoreController {

	public function init() {
	
		$orm = new OrmNode();		
		$fields = OrmNode::getFieldsFor($this->getModule());		
		$data = array();
		
		$data['mobilephone'] = request::get('phone');
		$data['message'] = request::get('text');
		$allFields = array_keys($fields);
		
		$rez = $orm->upsert($this->getModule(), $allFields, $data);	
		
		exit();
	}
}
