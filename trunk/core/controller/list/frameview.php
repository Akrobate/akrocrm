<?php

class List_Frameview extends CoreController {

	public $filter;

	public function init() {

		$list = new List_View();
		$modules = $this->getModule();
		CoreController::share($this, $list);
		
		$commande = request::get('commande');
		$start = request::get('start');
		
		if (!$this->filter) {
			$filter = request::get('filter');
			$this->setFilter($filter);
		} 
		
		$list->setFilter($this->filter);
		
		if ($start == "") {
			$start = 0;
		}
			
		if ($commande == 'next') {
			$start += $list->nbr;
		} elseif ($commande == 'prev') {
			$start -= $list->nbr;
		}
		
		if ($start < 0) {
			$start = 0;
		}
		
		$list->setStart($start);
		
		$list->setNbr($list->nbr);		
		$listContent = $list->renderSTR();

		if ($start >= $list->total) {
			$start = $list->total - $list->nbr;
		}



		$this->assign('total', $list->total);
		$this->assign('start', $start);
		$this->assign('list', $listContent);
		$this->assign('mainmodule', ucfirst($modules));		
	}
	
	
	public function setFilter($filter) {
		$this->filter = $filter;
	
	}
		
}
