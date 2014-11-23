<?php

class Main extends CoreController {

	public function __construct() {
		$this->template = "core/views/main.php";
	}
	
	public function init() {
		$content = $this->getvar('content');
		$contentSTR = $content->renderSTR();
		$this->assign('contentSTR', $contentSTR);
		$headers = ressources::$js;
		$this->assign('headers', $headers);
	}
	
}
