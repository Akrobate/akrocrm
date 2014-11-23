<?

class Controller extends CoreController {


	public function init() {

		$action = $this->action;
		$module = $this->module;
		
		if (users::isConnected()) {
				if ($action != "") {
		
					$moduleName = ucfirst($module);			
					$actionName = ucfirst($action);
			
					$customName = 'Modules_' . $moduleName . '_' . $actionName;
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
				$this->assign('sidebar', true);
		
				
		} else {
			
				$customName = 'Modules_Users_Login';
				$obj = new $customName();
				$this->assign('sidebar', false);
				$objstr = $obj->renderSTR();
				$this->assign('middle', $objstr);
		}
		
		}
	

}


