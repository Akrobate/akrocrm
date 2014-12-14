<?php

/**
 * @brief		Classe controlleur des dashlets de la page d'accueil
 * @details		Controlleur de Dashlet generique affichant simplement le compte d'item
 *				et les n plus recents éléments
 *				
 * @author		Artiom FEDOROV
 */
 
class Module_Dashlet extends CoreController {

	public function init() {

		$module = $this->getModule();
		$list = new List_Frameview();		

		$views = users::getProfile();
		$list->setFilter($views['view'][$module]['dashlet']['filter']);
		$list->setNbr(3);
		CoreController::share($this, $list);
		$listContent = $list->renderSTR();
		$total = $list->getTotal();
		
		$this->assign('listContent', $listContent);
		$this->assign('module', $module);
		$this->assign('total', $total);		

	}
}
