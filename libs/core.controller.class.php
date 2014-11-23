<?php



class CoreController {


	public $action;
	public $module;
	public $template;
	public $data;

	public function __construct() {
		$this->autoloadTemplate();
	}


	public function autoloadTemplate() {
	
		$classname = get_class($this);
		$exp2 = explode("_", strtolower($classname));
		$name = strtolower(array_pop($exp2));
		$exp = explode("_", strtolower($classname));
		$str = implode("/", $exp);
		
		// inclusion du template se fait toujours en commencant par custom puis core
		if (file_exists(PATH_CUSTOM_VIEWS . $str . ".php")) {
			$this->template = PATH_CUSTOM_VIEWS . $str . ".php";
		} else {
			if (file_exists(PATH_CORE_VIEWS . $str . ".php")) {
				$this->template = PATH_CORE_VIEWS . $str . ".php";
			} else {
				$this->template = PATH_CORE_VIEWS . 'module/' . $name . ".php";
			}
		}
	}
	
	
	public function setAction($action) {
		$this->action = $action;
		return $this;		
	}

	public function setModule($module) {
		$this->module = $module;
		return $this;
	}

	public function getAction() {
		return $this->action;
	}

	public function getModule() {
		return $this->module;
	}

	public function setTemplate($tpl) {
		$this->template = $tpl;
		return $this;		
	}


	public function assign($name,$val) {
		$this->data[$name] = $val;
		return $this;		
	}

	public function init() {
	
	}

	public function preinit() {

	}

	public function render() {
		$this->preinit();
		$this->init();
		$classname = get_class($this);
		//echo("Classname: " . $classname . " - " . $this->template);
		
		if (count($this->data)){
			extract($this->data);
		}
		include($this->template);
		
	}

	public function renderSTR() {
		$this->preinit();
		$this->init();
		ob_start();
		if (count($this->data)){
			extract($this->data);
		}
		include($this->template);
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}


	public static function share($from, $to) {
		$to->setAction($from->action);
		$to->setModule($from->module);	
	}
	
	
	public static function controllerExists($controller) {
	
		$path = "";		
		$explode = explode("_",$controller);
		$filename = strtolower(array_pop($explode));
		if (count($explode) > 0) {
			foreach($explode as $ex) {
				$path .= strtolower($ex) . '/';
			}
		}
		
		if (file_exists(PATH_CORE_CONTROLLER . $path . $filename . '.php')) {
			return true;
		} elseif (file_exists(PATH_CUSTOM_CONTROLLER . $path . $filename . '.php')) {
			return true;
		} else {
			return false;
		}
	}
	

}
