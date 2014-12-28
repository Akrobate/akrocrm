<?php

/**
 *	Controlleur main 
 *	@autor	Artiom FEDOROV
 *	@date	2014
 *
 */

class Main extends CoreController {

	/**
	 *	Surcharge du constructeur permettant de
	 *	Forcer la definition du templates
	 *
	 */

	public function __construct() {
		$this->template = "core/views/main.php";
	}


	/**
	 *	Surcharge de l'inist
	 *	Ici en fonction du format le main renvoi
	 *	un template ou un autre
	 *	
	 */
	 
	public function init() {
	
		// Verification du format
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
