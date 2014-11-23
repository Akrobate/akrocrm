<?

class Controller extends CoreController {


	public function init() {
	
		if ($this->action != "") {
			$action = $this->action;
			$module = $this->module;

			$moduleName = ucfirst($module);			
			$actionName = ucfirst($action);
			
			$customName = 'Module_' . $moduleName . '_' . $actionName;
			$coreName = 'Module_' . $actionName;
			
			if (CoreController::controllerExists($customName)) {
				$ctrName = $customName;
			} elseif(CoreController::controllerExists($coreName)) {
				$ctrName = $coreName;			
			}
			
			$obj = new $ctrName();		
			CoreController::share($this, $obj);
			$this->assign('right', $obj->renderSTR());
		}
		
		
		
		$allModules = ModuleManager::getAllModules();
		$this->assign('topLinks', $allModules);
	
		$obj = new Sidebar_View();
		$obj->setModulesList($allModules);
		$this->assign('left', $obj->renderSTR());
	
	}

}


