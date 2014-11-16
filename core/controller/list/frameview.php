<?php

class List_Frameview extends CoreController {

	public function init() {

		$list = new List_View();
		$modules = $this->getModule();
		CoreController::share($this, $list);
		$listContent = $list->renderSTR();
		$this->assign('list', $listContent);		
		$this->assign('mainmodule', ucfirst($modules));		
	}
		
}
