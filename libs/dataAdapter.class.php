<?
	
/**
 *	Classe d'adaptation des datas en leur présentation finale
 *		legerement inspiré du principe des listAdapter sous Androids
 *
 *	@author		Artiom FEDOROV
 *	@date		20/12/2014
 */

class DataAdapter {


	public static $allowedfields = array('text', 'join', 'largetext', 'photourl', 'date');


	/**
	 *	Methode permettant d'afficher les champs dans le mode d'action désiré
	 *
	 */

	public static function dataFieldsAdapter($data, $fieldslist, $fieldaction = 'view', $rendered = false, $format = ""){
		$ret = array();
		foreach($data as $field => $value) {
			if (isset($fieldslist[$field])) {
				$type = $fieldslist[$field]['type'];
			
				if (in_array($type, self::$allowedfields)) {
					$typename = ucfirst($type);
					$classname = "Field_".$typename;
					$obj = new $classname();
				} else {
					$obj = new Field_Text();
				}
			
				$obj->setAllFieldsParams($field, $fieldslist[$field]);
				$obj->setValue($value);	
				$obj->setAction($fieldaction);
				
				if (!empty($format)) {
					$obj->setFormat($format);
				}
				
				if ($rendered == 'rendered') {
					$ret[$field] = $obj->renderSTR();
				} else {
					$ret[$field] = $obj;
				}
			}
		}
		return $ret;	
	}
	
	
	/**
	 *	Methode permettant de generer un ensemble de fields vides
	 *	@param	fieldslist	Liste des champs au format d'inclusion modules car types necessaires
	 *	@param	fieldaction	Mode des champs a rendre
	 *	@param	rendered	bool	set le mode de rendu soit rendered soit liste d'objets
	 *	@return	Array	Renvoi soit les elements rendus dans un array soit les objets vers ces elements
	 *	
	 */
	
	public static function dataFieldsAdapterEmpty($fieldslist, $fieldaction = 'view', $rendered = false){
		$ret = array();
		
		foreach($fieldslist as $field => $val) {
		
			$type = $fieldslist[$field]['type'];
			
			if (in_array($type, self::$allowedfields)) {
				$typename = ucfirst($type);
				$classname = "Field_".$typename;
				$obj = new $classname();
			} else {
				$obj = new Field_Text();
			}
			$obj->setAllFieldsParams($field, $fieldslist[$field]);
			$obj->setValue("");	
			$obj->setAction($fieldaction);
	
		
			if ($rendered == 'rendered') {
				$ret[$field] = $obj->renderSTR();
			} else {
				$ret[$field] = $obj;
			}
		}
		return $ret;	
	}	
	
	
	/**
	 *	Methode permettant de recuperer la liste des champs
	 *	@param	module	Nom du module pour la recuperation de la liste des champs
	 *	@return	Array	Renvoi l'array déclaré dans l'include
	 *	
	 */
	
	public static function getFieldsFor($module) {
		if (!empty($module)){
			if (file_exists(PATH_MODULES . $module . "/fields.php")) {
				include(PATH_MODULES . $module . "/fields.php");					
			} else if (file_exists(PATH_CORE_INTERNAL_MODULES . $module . "/fields.php")) {
				include(PATH_CORE_INTERNAL_MODULES . $module . "/fields.php");
			}
			return $fields;
		}
	}


}