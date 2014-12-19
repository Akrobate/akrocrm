<?

class Controller extends CoreController {


	/** 
	 *	@briefMethode Point d'entrée de l'application
	 */

	public function init() {
	
		if (users::isConnected()) {
			$this->whenConnected();
		} else {
			$this->whenNotConnected();
		}
	}
	
	
	/**
	 *	@brief methode appelé quand l'utilisateur est connectée
	 */
	
	public function whenConnected() {
	
		if ($this->action != "") {
		
			$moduleName = ucfirst($this->module);			
			$actionName = ucfirst($this->action);
	
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
	
	}
	
	
	
	/**
	 *	@brief methode appelé quand l'utilisateur est n'est pas connecté
	 */
	
	public function whenNotConnected() {
	
		$customName = 'Modules_Users_Login';
		$obj = new $customName();
		$this->assign('sidebar', false);
		$objstr = $obj->renderSTR();
		$this->assign('middle', $objstr);
	}
	
}


