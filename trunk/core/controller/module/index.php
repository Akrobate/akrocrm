<?php

class Module_Index extends CoreController {

	public function init() {
	
		$id = request::get('id');
		$modules = $this->getModule();
		
		/*
		$list = new List_View();
		CoreController::share($this, $list);
		$listContent = $list->renderSTR();
		*/

		$list = new List_Frameview();
		CoreController::share($this, $list);
		$listContent = $list->renderSTR();


		$this->assign('listContent', $listContent);
		
		
		

	}
}
