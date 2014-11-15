<?

	define ("PATH_CURRENT", "./" );
	define ("PATH_CONFIGS", PATH_CURRENT. "config/");
	define ("PATH_LIBS", PATH_CURRENT . "libs/" );
	define ("LIBS_PATH", PATH_CURRENT . "libs/" );
	define ("PATH_SCRIPTS", PATH_CURRENT . "controllers/" );
	define ("PATH_TEMPLATES", PATH_CURRENT."templates/");
	define ("PATH_FONTS", PATH_CURRENT."public/fonts/");
	
	define ("PATH_MODULES", PATH_CURRENT . "modules/" );
	define ("PATH_CORE", PATH_CURRENT . "core/" );
	define ("PATH_CORE_CONTROLLER", PATH_CORE . "controller/" );	
	define ("PATH_CORE_VIEWS", PATH_CORE . "views/" );		

	include(PATH_CONFIGS . "db.php");
	include(PATH_LIBS . "sql.class.php");
	include(PATH_LIBS . "request.class.php");
	include(PATH_LIBS . "OrmNode.class.php");
	include(PATH_LIBS . "helper.class.php");	
	include(PATH_LIBS . "core.controller.class.php");
	
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
