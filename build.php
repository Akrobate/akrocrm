<?php

require_once("api.php");
//print_r ($argv);
$dirs = scandir(PATH_MODULES);
error_reporting(15);
$tree = array();
sql::display(1);

$nbr_items_per_table = 20;
$dirs =  ModuleManager::getAllModules();

$contactsrandomapi = true;


foreach($dirs as $dir) {
		if (sql::tableExists($dir)) {
			sql::removeTable($dir);
		}		
		unset($fields);
		$toinclude = PATH_MODULES . $dir . PATH_SEP ."fields.php";
		include($toinclude);
		$tree[$dir] = $fields;
		sql::createTable($dir, $fields);		
}


if (in_array("--people", $argv)) {


	foreach($dirs as $dir) {
		if($dir != 'contacts') {
			if (sql::tableExists($dir)) {
				unset($fields);
				$toinclude = PATH_MODULES . $dir . PATH_SEP ."fields.php";
				include($toinclude);
			
				for($j = 0; $j < $nbr_items_per_table; $j++) {
					$data = sql::peopleTable($dir, $fields);
					$obj = new OrmNode();
					$allFields = array_keys($fields);
					$obj->upsert($dir, $allFields, $data);				
				}
			}
		}
	}
	
	// People joins
	
	foreach($dirs as $dir) {
	
		if($dir != 'contacts') {
			$fields = OrmNode::getFieldsFor($dir);
			foreach ($fields as $name => $field) {
				if ($field['type'] == 'join') {			
					$joinmodule = $field['join']['table'];
					$orm = new OrmNode();
					$alldata = $orm->getAllData($joinmodule, array('id'=>'id'));
				
				
					foreach($alldata as $d) {
						$randjoin = rand(1, $nbr_items_per_table);
						$fields1 = OrmNode::getFieldsFor($dir);
						$data = array();
						$data[$name] = $randjoin;
						$allFields = array();
						$allFields[] = $name;
						$allFields[] = 'id';
						$data['id'] = $d['id'];
						$rez = $orm->upsert($dir, $allFields, $data);
					}
				}
			}
		}
	}
}



if (in_array("--realcontacts", $argv)) {

	$fields = OrmNode::getFieldsFor('contacts');
	$dir = 'contacts';
	if (sql::tableExists($dir)) {
		unset($fields);
		$toinclude = PATH_MODULES . $dir . PATH_SEP ."fields.php";
		include($toinclude);
			
		for($j = 0; $j < $nbr_items_per_table + 100; $j++) {
				$data = sql::peopleTableContacts($dir, $fields);
				$obj = new OrmNode();
				$allFields = array_keys($fields);
				$obj->upsert($dir, $allFields, $data);
				print_r($data);			
		}
	}
	
	
	
		$fields = OrmNode::getFieldsFor($dir);
		foreach ($fields as $name => $field) {
			if ($field['type'] == 'join') {			
				$joinmodule = $field['join']['table'];
				$orm = new OrmNode();
				$alldata = $orm->getAllData($joinmodule, array('id'=>'id'));
				
				
				foreach($alldata as $d) {
					$randjoin = rand(1, $nbr_items_per_table);
					$fields1 = OrmNode::getFieldsFor($dir);
					$data = array();
					$data[$name] = $randjoin;
					$allFields = array();
					$allFields[] = $name;
					$allFields[] = 'id';
					$data['id'] = $d['id'];
					$rez = $orm->upsert($dir, $allFields, $data);
				}
			}
		}
	
	
	

}



