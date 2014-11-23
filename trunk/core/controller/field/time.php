<?php

class Field_Time extends Field {
	
	public function init() {
		parent::init();
		if ($this->action == 'edit') {
			$this->addJS();
		}	
	}
	
	
}
