<?php

class OrmNode {

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


	public static function getData($module, $id) {
	
		$query = "SELECT * FROM $module WHERE id = $id";
		sql::query($query);
		$data = sql::allFetchArray();
		return $data[0];
		
	}


	public static function getAllData($module, $fields = array()) {
	
		$query = "SELECT * FROM $module WHERE 1";
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
