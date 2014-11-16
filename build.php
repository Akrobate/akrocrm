<?php

require_once("api.php");
//print_r ($argv);
$dirs = scandir(PATH_MODULES);
$tree = array();
sql::display(1);


$nbr_items_per_table = 50;


foreach($dirs as $dir) {
	if(($dir != "..") && ($dir != ".")&& ((strpos($dir, ".") === false))) {

		if (sql::tableExists($dir)) {
			sql::removeTable($dir);
		}
		
		unset($fields);
		$toinclude = PATH_MODULES . $dir . "/"."fields.php";
		include($toinclude);
				echo($toinclude);
		$tree[$dir] = $fields;
		
		//	echo($dir);
		sql::createTable($dir, $fields);		

	}
}


if (in_array("--people", $argv)) {
	
	foreach($dirs as $dir) {
		if(($dir != "..") && ($dir != ".") && ((strpos($dir, ".") === false)) ) {

			if (sql::tableExists($dir)) {
				unset($fields);
				$toinclude = PATH_MODULES . $dir . "/"."fields.php";
				include($toinclude);
				
				for($j = 0; $j < $nbr_items_per_table; $j++) {
					$data = sql::peopleTable($dir, $fields);
					
					// print_r($data);
					// print_r($dir);
					
					$obj = new OrmNode();
					
					$allFields = array_keys($fields);
					$obj->upsert($dir, $allFields, $data);				
				}
			}
		
		
		}
	}
	
	
	// People joins	
	
	$dirs =  ModuleManager::getAllModules();
	foreach($dirs as $dir) {
	
	
		$fields = OrmNode::getFieldsFor($dir);
		foreach ($fields as $name => $field) {
		
			if ($field['type'] == 'join') {
				
				$joinmodule = $field['join']['table'];
				$orm = new OrmNode();
				$alldata = $orm->getAllData($joinmodule, array('id'=>'id'));
				$ids = OrmNode::getFieldListFromDataSet($alldata);
				
				
				
				foreach($alldata as $d) {
				
					$randjoin = rand(1, $nbr_items_per_table);
					//print_r($randjoin);
					$fields1 = OrmNode::getFieldsFor($dir);
					
					$data = array();

					$data[$name] = $randjoin;
	
					$allFields = array();
					$allFields[] = $name;
					$allFields[] = 'id';
					$data['id'] = $d['id'];
						
					//print_r ($data);
					//exit();
						
						
					$rez = $orm->upsert($dir, $allFields, $data);
					
				}
				
			}
		}
	}
	
	
	

}
