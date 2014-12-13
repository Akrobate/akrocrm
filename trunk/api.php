<?

	define ("PATH_SEP", '/');	
	define ("PATH_CURRENT", "." . PATH_SEP );
	define ("PATH_CONFIGS", PATH_CURRENT. "config" . PATH_SEP);	
	define ("PATH_LIBS", PATH_CURRENT . "libs" . PATH_SEP );
	define ("LIBS_PATH", PATH_CURRENT . "libs" . PATH_SEP );
	define ("PATH_FONTS", PATH_CURRENT."public/fonts/");
	define ("PATH_MODULES", PATH_CURRENT . "modules/" );
	define ("PATH_CORE", PATH_CURRENT . "core/" );
	define ("PATH_CORE_CONTROLLER", PATH_CORE . "controller/" );	
	define ("PATH_CORE_VIEWS", PATH_CORE . "views/" );
	define ("PATH_CUSTOM", PATH_CURRENT. "custom" . PATH_SEP);	
	define ("PATH_CUSTOM_CONTROLLER", PATH_CUSTOM . "controller" . PATH_SEP);	
	define ("PATH_CUSTOM_VIEWS", PATH_CUSTOM . "views". PATH_SEP);
	define ("PATH_CORE_INTERNAL_MODULES", PATH_CORE . "internalmodules/" );	

	define ("PATH_CORE_RESSOURCES_JS", PATH_CORE . "ressources/js/". PATH_SEP);		
	define ("URL_CORE_RESSOURCES_JS", "core/ressources/js/". PATH_SEP);

	define ("ADMIN_LOGIN", "admin");
	define ("ADMIN_PASSWORD", "admin");

	require_once(PATH_CONFIGS . "db.php");
	require_once(PATH_LIBS . "sql.class.php");
	require_once(PATH_LIBS . "request.class.php");
	require_once(PATH_LIBS . "dataAdapter.class.php");
	require_once(PATH_LIBS . "OrmNode.class.php");
	require_once(PATH_LIBS . "helper.class.php");	
	require_once(PATH_LIBS . "html.render.class.php");	
	require_once(PATH_LIBS . "core.controller.class.php");
	require_once(PATH_LIBS . "modulemanager.class.php");
	require_once(PATH_LIBS . "datanode.class.php");
	require_once(PATH_LIBS . "users.class.php");
	
	require_once(PATH_CURRENT . "routeur.php");

