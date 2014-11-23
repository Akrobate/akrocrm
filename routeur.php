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
		
		if (file_exists(PATH_CORE_CONTROLLER . $path . $filename . '.php')) {
			include PATH_CORE_CONTROLLER . $path . $filename . '.php';
		} else if (file_exists(PATH_CUSTOM_CONTROLLER . $path . $filename . '.php')){
			include PATH_CUSTOM_CONTROLLER . $path . $filename . '.php';
		}
		
		
	});
