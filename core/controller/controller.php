<?

class Controller extends CoreController {


	public function init() {
	
		if ($this->action != "") {
			$action = $this->action;
			$ctrName = ucfirst($action);
			$obj = new $ctrName();		
			CoreController::share($this, $obj);
			$this->assign('right', $obj->renderSTR());
		}
	
	}

}


