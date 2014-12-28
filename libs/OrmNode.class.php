<?php


/**
 *	Classe qui represente un data Node
 *	@author Artiom FEDOROV
 *
 */

class OrmNode extends DataAdapter {

	
	public static $joins = array();
	// @TODO Time a finaliser (format dentrée et icone up/down

	public $filter;
	
	public $start_limit;
	public $nbr_limit;
	public $total;
	
	
	public function __construct() {
		$this->start_limit = 0;
		$this->nbr_limit = 10;
		$this->total = 0;	
	}

	
	public function setFilter($filter) {
		$this->filter = $filter;
	}


	
	public static function getAllObj() {
		$query="SHOW TABLES";
		sql::query($query);
		return sql::allFetchArray();	
	}
	
	
	public static function getFields($module) {	
		$fields = self::getFieldsFor($module);
		$allFields = array_keys($fields);
		return $allFields;
	}


	/**
	 *	Methode de recuperation des datas
	 *	@brief	Recupere la data depuis la table module	
	 *	@param	module	Le nom du module (nom de la table)
	 *	@param	id		L'id de l'enregistrement a recuperer
	 *	@return	Array	Renvoi l'array de l'enregistrement
	 */

	public static function getData($module, $id) {
		$query = "SELECT * FROM $module WHERE id = $id";
		sql::query($query);
		$data = sql::allFetchArray();
		return $data[0];		
	}


	public static function addJoin($table) {
		self::$joins = $table;
	}


	public function getAllDataWithJoins($module, $listFields = array()) {
		$content = $this->getAllData($module, $listFields);	
		$joins_data = array();
		foreach($listFields as $jname=>$join) {
			if ($join['type'] == 'join') {
				$join_module = $join['join']['table'];
				$joins_data[$jname] = $this->getJoinData($join_module, $this->getFieldListFromDataSet($content, $jname));
				$this->glueJoinDataToData($content, $joins_data[$jname], $jname);
			}
		}
		return $content;
	}


	public function getAllData($module, $fields = array()) {
		if (isset($this->filter) && $this->filter != '') {
			$query = "SELECT * FROM $module WHERE " . $this->filter;
		} else {
			$query = "SELECT * FROM $module WHERE 1";		
		}

		sql::query($query);
		$this->total = sql::nbrRows();
		$query .= " LIMIT  " . $this->start_limit . ", " . $this->nbr_limit;
		sql::query($query);
		$data_origin = sql::allFetchArray();
		$data_to = array();
		foreach($data_origin as $data) {
			$tmp = array();			
			foreach ($fields as $fieldname=>$field) {
				$tmp[$fieldname] = $data[$fieldname];
			}		
			$data_to[] = $tmp;
		}
		return $data_to;
	}


	public static function getJoinData($module, $id = array() ) {
		$query = "SELECT * FROM $module WHERE id IN (";
		$query .= implode(',', $id) ;
		$query .= ");";
		sql::query($query);
		$data = sql::allFetchArray();
		$data2 = array();
		foreach($data as $d) {
			$data2[ $d['id'] ] = $d;
		}
		return $data2;
	}
	
	
	public static function getFieldListFromDataSet($data, $field) {
		$ret = array();
		foreach($data as $d) {
			$ret[$d[$field]] = $d[$field];
		}
		return $ret;
	}
	
	
	/**
	 *	Methode permettant de rajouter au set de data les join data
	 */
	
	public static function glueJoinDataToData(&$data, $joindata, $field) {
		foreach($data as &$d) {
			if ($d[$field]){
				$d[$field] = $joindata[ $d[$field] ];
			} 
		}
		return $data;
	}

	
	/**
	 *	Methode generique de save de tout module
	 *	@param	module	Le nom du module a sauvegarder (table de destination)
	 *	@param	fields	Liste de champs a sauvegarder ex: Array('nom','prenom',etc..);
	 *	@param	data	Array contenant les donnés a sauvegarder ex: Array ('nom' => Jean, 'prenom'=>'Pierre')
	 *	@return	Array	Renvoi un array contenant msg qui dit s'il y a eut ajout ou edition
	 *											id representant l'id de l'enregistrement conserné
	 *											query	pour debug la chaine envoyé en mysql	
	 */


	public function upsert($module, $fields, $data) {
	
		$nbr_fields = count($fields);
		$data_string_array = array();
		$fields_string = implode(',',$fields);
		$data_string = "";
		foreach($fields as $field) {
			if (isset($data[$field]) && (!empty($data[$field]))) {
				$data_string_array[$field] = '"'.  sql::escapeString( $data[$field] ) .'"';
			} else {
				$data_string_array[$field] = '""';		
			}	
		}		
			
		if (isset($data['id']) && ($data['id'] != 0)) {
		
			foreach($fields as $field) {
				$data_string .= $field . '=' . sql::escapeString( $data_string_array[$field] ) . ',';
			}
			$data_string = substr($data_string, 0, -1);
			$query = 'UPDATE ' . $module . ' SET '. $data_string . ' WHERE id=' . $data['id'];	
			sql::query($query);		
			$response['msg'] = 'EDITED';
			$response['id'] = $data['id'];
			$response['query'] = $query;
			
		} else {
			$data_string = implode(',',$data_string_array);
			$query = 'INSERT INTO ' . $module . ' ('.$fields_string.') VALUES ('. $data_string .');';
			sql::query($query);			
			$lastid = sql::lastId();
			$response['msg'] = 'ADDED';
			$response['id'] = $lastid;
			$response['query'] = $query;

		
		}
		return $response;
	}

}
