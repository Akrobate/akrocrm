<?php

class html {

	

}


// Ici bientot l'implementation complete de l'extension ressources

class ressources {

	public static $js = array();

	// Verifier qu'une ressource n'est incluse qu'une fois	
	public static function addJs($js) {
		self::$js[] = $js;
	}
}


