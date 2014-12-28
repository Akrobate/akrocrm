<?php

/**
 *	Cette classe est le controlleur qui gere
 *	l'ajout de sms depuis dans le crm
 *	par appel depuis un appareil exterieur
 *	
 *	Recupere simplement deplus l'url en get les parametres
 *		phone
 *		text
 *
 *	Pour insertion en base dans le module messages		
 *
 *	@author	Artiom FEDOROV
 *	@date	2014
 *
 */

class Modules_Messages_Smsadd extends CoreController {

	/**
	 *	Surchage principale
	 *
	 */

	public function init() {
	
		$orm = new OrmNode();		
		$fields = OrmNode::getFieldsFor($this->getModule());		
		$data = array();
		
		$data['mobilephone'] = request::get('phone');
		$data['message'] = request::get('text');
		$allFields = array_keys($fields);
		$rez = $orm->upsert($this->getModule(), $allFields, $data);	

		// On est en mode "Pseudo API" donc je kill l'execution a la fin volontairement
		exit();
	}
}
