<?php

class Field_Date extends Field {
	
	public function init() {
		parent::init();
		if ($this->action == 'edit') {
			$this->addJS();
		}	
	}
	
	
}
