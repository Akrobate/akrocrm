<?php

/**
 *	Classe Permettant la gestion des listes
 *	Ils s'agit ici de la classe la plus bas niveau des listes
 *
 *	@brief Premet la gestion des listes avec le composant fields
 *	@author Artiom FEDOROV
 *
 */


class List_View extends CoreController {

	public $start;
	public $nbr;
	public $total;

	/**
	 *	Methode constructeur surcharge avec init du nombre et start
	 *
	 */

	public function __construct() {
		parent::__construct();
		$this->start = 0;
		$this->nbr = 10;
	}


	/**
	 *	Methode constructeur surcharge avec init du nombre et start
	 *
	 */
	 
	public function init() {
		
		$orm = new OrmNode();
		
		$orm->start_limit = $this->start;
		$orm->nbr_limit = $this->nbr;		
		$listFields = $this->getListFields();
		
		//print_r($listFields);
		
		$orm->setFilter($this->filter);
		$content = $orm->getAllDataWithJoins($this->getModule(), $listFields);
		
		$this->total = $orm->total;
		
		$result = array();
		$resultArray = array();
		
		foreach($content as $cntk => $cnt) {
			$result[] = OrmNode::dataFieldsAdapter($cnt, $listFields, 'list', 'rendered', $this->getFormat());
			$resultArray[] = $cnt;
		}
		
		$this->assign('fieldList', $listFields);
		$this->assign('datas', $result);
		$this->assign('datasForApi', $resultArray);
		
	}
	
	
	/**
	 *	Methode qui renvoi la liste des champs
	 *	Pour le module courants
	 *	@return	Array	Tableau des champs
	 *
	 */
	
	public function getListFields() {
		$fields = OrmNode::getFieldsFor($this->getModule());
		$fields['id'] = array('label'=>'id', 'type'=>'int');
		return $fields;		
	}


	/**
	 *	Setteur pour le filtre de la liste
	 *	@param	filter	Chaine de carractere représentant le filtre	
	 *	@return	this	Renvoi this pour le chainage
	 *
	 */
	 
	public function setFilter($filter) {
		$this->filter = $filter;
		return $this;
	}
	

	/**
	 *	Setteur pour le start de la liste
	 *	@param	start	Entier représentant le LIMIT de début
	 *	@return	this	Renvoi this pour le chainage
	 *
	 */	
	 
	public function setStart($start) {
		$this->start = $start;
		return $this;
	}
	
	
	/**
	 *	Setteur pour le nombre de résultats par page
	 *	@param	start	Entier représentant le LIMIT de nbr de results
	 *	@return	this	Renvoi this pour le chainage
	 *
	 */	
	 
	public function setNbr($nbr) {
		$this->nbr = $nbr;
		return $this;
	}
	
	
	
}
