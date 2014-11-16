<?php

	spl_autoload_register(function ($class) {
		// core class
		$path = "";		
		$explode = explode("_",$class);
		$filename = strtolower(array_pop($explode));
		if (count($explode) > 0) {
			foreach($explode as $ex) {
				$path .= strtolower($ex) . '/';
			}
		} 
		include PATH_CORE_CONTROLLER . $path . $filename . '.php';	
	});
