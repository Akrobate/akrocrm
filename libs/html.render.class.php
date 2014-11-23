<?php

class html {

	public static function dataGrid($array) {

		$str = self::htmlStartTable($array[0]);

		foreach($array as $key => $val) {
			$str .= self::htmlTR($val);
		}
	
		$str .= self::htmlStopTable($array[0]);
		return $str;
	}
	
	
	
	public static function htmlStartTable($array) {
		$keys = array_keys($array);

		$str = "<table style='border:1px solid grey'>\n<tr>\n";

		foreach ($keys as $val) {
			if (!is_numeric($val)) {
				$str .= "<th>$val</th>\n";
			}			
		}
		$str .= "</tr>";
		return $str;
	}
	
	public static function htmlStopTable() {
		$str = "</table>";
		return $str;	
	}
	
	public static function htmlTR($array) {
		
			$str = "<tr>";
			foreach($array as $key => $subval) {
				if (!is_numeric($key)) {
					$str .= "<td style='border:1px solid grey'>$subval</td>\n";
				}
			}
			$str .= "</tr>\n\n";
		return $str;
	
	}

}



// Ici bientot l'implementation complete de l'extension ressources

class ressources {

	public static $js = array();

	// Verifier qu'une ressource n'est incluse qu'une fois	
	public static function addJs($js) {
		self::$js[] = $js;
	}
}


