<?

	define ("PATH_SEP", '/');	

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
	include(PATH_LIBS . "modulemanager.class.php");
	include(PATH_LIBS . "datanode.class.php");	
	
	include(PATH_CURRENT . "routeur.php");

