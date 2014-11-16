<?

class Controller extends CoreController {


	public function init() {
	
		if ($this->action != "") {
			$action = $this->action;
			$ctrName = ucfirst($action);
			$ctrName = 'Module_' . $ctrName;
			$obj = new $ctrName();		
			CoreController::share($this, $obj);
			$this->assign('right', $obj->renderSTR());
		}
		
		
		$allModules = ModuleManager::getAllModules();
		$this->assign('topLinks', $allModules);
	
	}

}


