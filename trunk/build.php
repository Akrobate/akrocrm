<?php

require_once("api.php");
//print_r ($argv);
$dirs = scandir(PATH_MODULES);
$tree = array();
sql::display(1);


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
				
				for($j = 0; $j < 50; $j++) {
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

}
