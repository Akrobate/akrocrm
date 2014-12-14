<?php

class Modules_Home_Index extends CoreController {


	public function init() {

			$modules = ModuleManager::getAllModules();
			$dashlets = array();
			foreach($modules as $module) {

				$moduleName = ucfirst($module);			
				$actionName = "Dashlet";
				$customName = 'Modules_' . $moduleName . '_' . $actionName;
				$coreName = 'Module_' . $actionName;
		
				if (CoreController::controllerExists($customName)) {
					$ctrName = $customName;
				} elseif(CoreController::controllerExists($coreName)) {
					$ctrName = $coreName;			
				}	
				$obj = new $ctrName();		
				CoreController::share($this, $obj);
				$obj->setModule($module);
				$dashlets[] = $obj->renderSTR();
			}
			$this->assign('dashlets', $dashlets);
				
	}


}
