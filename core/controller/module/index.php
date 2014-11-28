<?php

class Module_Index extends CoreController {

	public function init() {
		$id = request::get('id');
		$modules = $this->getModule();
		$list = new List_Frameview();
		
		
		
		$views = users::getProfile();
		
//		echo($views['view'][$modules][list']['filter']);
		$list->setFilter($views['view'][$modules]['list']['filter']);
		
		
		
		CoreController::share($this, $list);
		$listContent = $list->renderSTR();
		$this->assign('listContent', $listContent);
	}
}
