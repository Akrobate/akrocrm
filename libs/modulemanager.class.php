<?php

class ModuleManager {

	public static function getAllModules() {
	
		$dirs = scandir(PATH_MODULES);
		$rez = array();
		
		foreach($dirs as $dir) {
			if(($dir != "..") && ($dir != ".")&& ((strpos($dir, ".") === false))) {
				$rez[] = $dir;
			}
		}
		
		return $rez;
	}



	public static function getJoinsOnModule($module) {
	
		$ret = array();
		$allmodules = self::getAllModules();
		foreach($allmodules as $mod) {
			$fields = OrmNode::getFieldsFor($mod);
			foreach($fields as $k=>$v) {
				if (isset($v['join']['table']) && $v['join']['table'] == $module) {
					$ret[$mod][$k] = $v;
				}
			}
			
		}
		return $ret;
		
	}

}
