<?php

class List_Subpanel extends CoreController {

	public function init() {

		$list = new List_View();
		$modules = $this->getModule();
		CoreController::share($this, $list);

		$list->setFilter($this->filter);
		$list->setNbr($list->nbr);

		$listContent = $list->renderSTR();
		$start = 0;
		$this->assign('total', $list->total);
		$this->assign('start', $start);
		$this->assign('list', $listContent);
		$this->assign('mainmodule', ucfirst($modules));		
	}
		
		
	public function setFilter($filter) {
		$this->filter = $filter;
	}
		
		
}
