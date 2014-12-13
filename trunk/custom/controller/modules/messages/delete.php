<?php

class Modules_Messages_Delete extends CoreController {

	public function init() {
		$id = request::get('id');
		sql::query('DELETE FROM ' . $this->getModule() . " WHERE id = " . $id);
		url::redirect($this->getModule(), 'index');
	}
}
