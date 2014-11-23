<?php

/* USAGE
clear;php customize.php --module=notes --action=edit
*/


require_once("api.php");
$dirs = scandir(PATH_MODULES);
error_reporting(15);
$tree = array();
sql::display(1);

foreach($argv as $a) {
	if (strpos($a, 'module') !== false) {
		$exp = explode("=", $a);
		$val = $exp[1];
		$module = trim($val);
	}
	
	if (strpos($a, 'action') !== false) {
		$exp = explode("=", $a);
		$val = $exp[1];
		$actions = trim($val);
		if (strpos($actions, ",") !== false) {
			$actions = explode(",",$actions);
		} else {
			$actions = (array)$actions;
		}		
	}

	if (strpos($a, 'remove') !== false) {
		$exp = explode("=", $a);
		$val = $exp[1];
		$remove = true;		
	} else {
		$remove = false;
	}		
}

$module = trim(strtolower($module));

if ($module == "") {
	exit();
}


// On verifie si le dossier existe:
if (file_exists(PATH_CUSTOM_CONTROLLER .  'module/' . $module)) {
	echo("exists\n");
} else {
	echo("Do not exists \n");
	echo("Creating \n");
	echo(PATH_CUSTOM_CONTROLLER .  'module/' . $module . "\n");
	mkdir(PATH_CUSTOM_CONTROLLER .  'module/' . $module);
}


foreach($actions as $action) {
	$str = file_get_contents(PATH_CORE_CONTROLLER .  'module/' . $action . ".php");
	$coreName = 'Module_' . ucfirst($action);
	$customName = 'Module_' . ucfirst($module) . "_" . ucfirst($action);	
	$str = str_replace($coreName, $customName, $str);
	file_put_contents(PATH_CUSTOM_CONTROLLER .  'module/' . $module . "/" . $action . ".php", $str);
	echo($customName . "\n");

}

