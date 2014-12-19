<?php

class Module_Index extends CoreController {

	/** 
	 *	@brief	Méthode declanchant la récupération de résultats
	 *	
	 */

	public function init() {
		$id = request::get('id');
		$module = $this->getModule();
		$list = new List_Frameview();
		$views = users::getProfile();

		if (isset($views['view'][$module]['list']['filter'])){
			$list->setFilter($views['view'][$module]['list']['filter']);
		}
		
		CoreController::share($this, $list);
		$listContent = $list->renderSTR();

		$this->assign('listContent', $listContent);
		
	}
}
