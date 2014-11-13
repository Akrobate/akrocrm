<?php



class Edit extends CoreController {

	public function __construct() {
		$this->template = "core/views/edit.php";
	}

	public function init() {
	
		$id = request::get('id');
		
		$fields = OrmNode::getFieldsFor($this->getModule());
		//$fields = "mega test";
		
		$data = array();
		$orm = new OrmNode();
		
		//echo("<h1>ICI<br>ICI</h1>");
		$content = $orm->getData($this->getModule(), $id);
		//print_r($content);
		
		// creation de tous les objets
		foreach($fields as $fieldname=>$field) {
		
			if ($field['type'] == 'text') {
			
				unset($obj);
				$obj = new FieldText();
				$obj->setAction('edit');
				$obj->setValue($content[$fieldname]);
				$obj->setName($fieldname);
				$obj->setLabel($field['label']);
				$data[] = $obj->renderSTR();
			
			}
			
		}
		
		//$this->assign('data', $fields);
		$this->assign('fields', $data);
		$this->assign('id', $id);
	}









}
