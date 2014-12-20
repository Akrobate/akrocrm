<?php

class Main extends CoreController {


	public function __construct() {

		$this->template = "core/views/main.php";
		
	}


	
	public function init() {
	
		if ($this->format == "angular") {
			$this->template = "core/views/mainAngular.php";
		} else {
			$this->template = "core/views/main.php";
			$content = $this->getvar('content');
			$contentSTR = $content->renderSTR();
			$this->assign('contentSTR', $contentSTR);
			$headers = ressources::$js;
			$this->assign('headers', $headers);
		}
	}
	
}
