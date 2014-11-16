<?php

class OrmNode {

	public static $joins = array();

	public static $allowedfields = array('text', 'join', 'largetext');

	public $filter;
	
	public function setFilter($filter) {
	
		$this->filter = $filter;
	
	}

	public static function getFieldsFor($module) {
		if (!empty($module)){
			include("modules/$module/fields.php");
			//print_r($fields);
			return $fields;
		}
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
	 * 
	 */


	public static function dataFieldsAdapter($data, $fieldslist, $fieldaction = 'view', $rendered = false){
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
				if ($rendered == 'rendered') {
					$ret[$field] = $obj->renderSTR();
				} else {
					$ret[$field] = $obj;
				}
			}
		}
		return $ret;	
	}




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
	
	public static function glueJoinDataToData(&$data, $joindata, $field) {

		foreach($data as &$d) {

			if ($d[$field]){
				$d[$field] = $joindata[ $d[$field] ];
			} 
		}

		return $data;
	}



	public function upsert($module, $fields, $data) {

		$nbr_fields = count($fields);
		$data_string_array = array();
		$fields_string = implode(',',$fields);
		$data_string = "";
		foreach($fields as $field) {
			if (isset($data[$field]) && (!empty($data[$field]))) {
				$data_string_array[$field] = '"'. $data[$field] .'"';
			} else {
				$data_string_array[$field] = '""';		
			}	
		}
	
		if (isset($data['id']) && ($data['id'] != 0)) {
		
			foreach($fields as $field) {
				$data_string .= $field . '=' . $data_string_array[$field] . ',';
			}
			$data_string = substr($data_string, 0, -1);
		
			$query = 'UPDATE ' . $module . ' SET '. $data_string . ' WHERE id=' . $data['id'];	
			sql::query(utf8_decode($query));		
			$response['msg'] = 'EDITED';
			$response['id'] = $data['id'];
			$response['query'] = $query;
		
		} else {
			$data_string = implode(',',$data_string_array);
			$query = 'INSERT INTO ' . $module . ' ('.$fields_string.') VALUES ('. $data_string .');';
			sql::query(utf8_decode($query));
			$lastid = sql::lastId();
			$response['msg'] = 'ADDED';
			$response['id'] = $lastid;
			$response['query'] = $query;
			return $response;
		
		}
	}

}
