<?php

/**
 *	Cette classe gere les subpannelss
 *	
 *	@brief	Gestion des subpannels
 *	
 *	@author	Artiom FEDOROV
 *	@date	19/12/2014
 */

class List_Subpanel extends CoreController {


	/**
	 *	Surcharge de l'init
	 *	
	 *	Recupere le module et genere une liste de prévisuatisation
	 *	
	 */

	public function init() {

		$list = new List_View();
		$modules = $this->getModule();
		CoreController::share($this, $list);
		$list->setFilter($this->filter);
		$list->setNbr($list->nbr);
		$listContent = $list->renderSTR();
		$this->assign('total', $list->total);
		$this->assign('start', 0);
		$this->assign('list', $listContent);
		$this->assign('mainmodule', ucfirst($modules));		
	}
	
	
	/**
	 *	@brief	Setteur de filtres
	 *	@details	Methode interne permettant de setter le filtre
	 *				pour la liste du subpannel
	 *	
	 */
		
	public function setFilter($filter) {
		$this->filter = $filter;
	}	
}
