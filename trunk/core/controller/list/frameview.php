<?php

/**
 * @brief		Classe controlleur de l'encapsulation de listes
 * @details		Controlleur permettant de manipuler les listes, contient
 *				la pagination et est chargé de gerer la list_view
 *				
 * @author		Artiom FEDOROV
 */

class List_Frameview extends CoreController {

	public $filter;
	public $total;
	public $nbr;
	
	/**
	 * @brief		Methode d'initialisation du frameview
	 * @details		Méthode qui gere l'ensemble de la pagination
	 * @return	null
	 */

	public function init() {

		$list = new List_View();
		$modules = $this->getModule();
		CoreController::share($this, $list);
		
		$commande = request::get('commande');
		$start = request::get('start');
		
		// Si le filtre n'est pas set alors je recupere celui dans l'url
		if (!$this->filter) {
			$filter = request::get('filter');
			$this->setFilter($filter);
		} 
			
		$list->setFilter($this->filter);
		
		if ($this->nbr) {
			$list->setNbr($this->nbr);
		}

		if ($start == "") {
			$start = 0;
		}
		
		$prevStart = $start - $list->nbr;		
		$nextStart = $start + $list->nbr;
		
		$list->setStart($start);
		$listContent = $list->renderSTR();
		
		if ($list->total < $list->nbr) {
			$nextStart = $start;
		}
		
		if ($start + $list->nbr > $list->total) {
			$nextStart = $start;
		}
		
		if ($start - $list->nbr < 0) {
			$prevStart = $start;
		}
		
		$this->setTotal($list->total);
		$this->assign('total', $list->total);
		$this->assign('start', $start);
		
		$this->assign('nextStart', $nextStart);
		$this->assign('prevStart', $prevStart);
				
		$this->assign('list', $listContent);
		$this->assign('mainmodule', ucfirst($modules));		
	}
	
	
	/**
	 * @brief		Methode permettant d'initialiser le filte
	 * @details		setteur pour le filtre, si le filtre n'est pas set alors
	 *				le filtre est set a chaine vide
	 * @return	this	Renvoi l'objet courant
	 */

	public function setFilter($filter) {
		if (isset($filter)) {
			$this->filter = $filter;
		} else {
			$this->filter = "";
		}
		return $this;
	}
	
	
	/**
	 * @brief		Methode permettant d'initialiser le nombre total de resultats
	 * @details		setteur pour le nombre total de résultats
	 * @param	nbr		Nombre total de résultats a set au niveau de l'objet
	 * @return	this	Renvoi l'objet courant
	 */

	public function setTotal($nbr) {
		$this->total = $nbr;
		return $this;
	}
	
	
	/**
	 * @brief	Getteur pour le total
	 * @return	int	Renvoi le nombre total
	 */

	public function getTotal() {
		return 	$this->total;
	}
		
	
	/**
	 * @brief		Methode permettant d'initialiser le nombre total de resultats a afficher
	 * @details		setteur pour le nombre total de résultats a afficher
	 * @param	nbr		Nombre total de résultats a set au niveau de l'objet
	 * @return	this	Renvoi l'objet courant
	 */

	public function setNbr($nbr) {
		$this->nbr = $nbr;
		return $this;
	}
		
}
