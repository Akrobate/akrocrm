<?php

/**
 *	@brief	Classe dont extends quasi tous les controlleurs de l'application
 *	Cette classe gere l'inclusion des templates
 *	@author	Artiom FEDOROV
 *
 */

class CoreController {


	public $action;
	public $module;
	public $format;
	public $template;
	public $data;

	public static $headressources = array();

	public function __construct() {
		$this->autoloadTemplate();
	}


	// Concu pour les fields Devra bouger d'ici dans fields.php ici une methode plus generique
	
	
	public function addJS($js = "")	{

		if ($js == "") {

			$classname = get_class($this);			
			$action = $this->getAction();			
			$exp = explode("_", strtolower($classname . "_" .$action));
			$str = implode("/", $exp);
			
			if (file_exists(PATH_CORE_RESSOURCES_JS . $str . ".js")) {
				ressources::addJs(URL_CORE_RESSOURCES_JS . $str . ".js");
			}
		} else {
			ressources::addJs($js);
		}
		
	}	


	/**
	 *	Méthode destinée a être surchargée dans les sous controlleurs
	 *
	 */

	public function init() {
	
	}


	/**
	 *	Méthode destinée a être surchargée dans les sous controlleurs
	 *
	 */

	public function preinit() {

	}

	public function autoloadTemplate() {
	
		$classname = get_class($this);
		$exp2 = explode("_", strtolower($classname));
		$name = strtolower(array_pop($exp2));
		$exp = explode("_", strtolower($classname));
		$str = implode("/", $exp);
		
		// inclusion du template se fait toujours en commencant par custom puis core
		if (file_exists(PATH_CUSTOM_VIEWS . $str . ".php")) {
			$this->template = PATH_CUSTOM_VIEWS . $str . ".php";
		} else {
			if (file_exists(PATH_CORE_VIEWS . $str . ".php")) {
				$this->template = PATH_CORE_VIEWS . $str . ".php";
			} else {
				$this->template = PATH_CORE_VIEWS . 'module/' . $name . ".php";
			}
		}
	}
	
	
	/**
	 *	@brief		Setteur d'Action
	 *	@return		this Renvoi la classe courante
	 */
	
	public function setAction($action) {
		$this->action = $action;
		return $this;		
	}


	/**
	 *	@brief		Setteur de Modules
	 *	@return		this Renvoi la classe courante
	 */
	 
	public function setModule($module) {
		$this->module = $module;
		return $this;
	}


	/**
	 *	@brief		Setteur de format
	 *	@return		this Renvoi la classe courante
	 */

	public function setFormat($format) {
		$this->format = $format;
		return $this;
	}


	/**
	 *	@brief		Getteur d'action
	 *	@return		string Renvoi le nom de l'action
	 */
	 
	public function getAction() {
		return $this->action;
	}


	/**
	 *	@brief		Getteur de modules
	 *	@return		string Renvoi le nom module
	 */

	public function getModule() {
		return $this->module;
	}
	
	
	/**
	 *	@brief		Getteur de format
	 *	@return		string Renvoi le format
	 */
	
	public function getFormat() {
		return $this->format;
	}

	public function setTemplate($tpl) {
		$this->template = $tpl;
		return $this;		
	}


	public function assign($name,$val) {
		$this->data[$name] = $val;
		return $this;		
	}
	
	public function getvar($name) {
		return $this->data[$name];
	}	


	/**
	 *	@brief		Méthode qui execute l'ensemble du processus
	 *	@return 	string	Renvoi le rendu vers la sortie standard
	 *
	 */

	public function render() {
		echo $this->renderSTR();
	}
	

	/**
	 *	@brief		Méthode qui execute l'ensemble du processus
	 *	@return 	string	Renvoi le rendu dans une variable
	 *
	 */
	 
	public function renderSTR() {
		$this->preinit();
		$this->init();
		$content = "";
		if ($this->isFormatJson()) {
			if ($this->getJsonDataForApi()) {
				$content = $this->getJsonDataForApi();
				echo($content);
			}
		} else {
			ob_start();
			if (count($this->data)){
				extract($this->data);
			}
			include($this->template);
			$content = ob_get_contents();
			ob_end_clean();
		}
		return $content;
	}


	/**
	 *	@brief		Méthode de detection du format json
	 *	@return 	bool	Renvoi si le template courant est en mode json
	 *
	 */

	public function isFormatJson() {
		return ($this->format == 'json');
	}


	/**
	 *	@brief	Methode permettant de render du json
	 *
	 */

	public function getJsonDataForApi() {
	
		if (isset($this->data['datasForApi'])) {
			return json_encode($this->data['datasForApi']);		
		} else {
			return false;
		}
	}




	/**
	 *	@brief		Méthode statique de partage de proprietés
	 *	@details	Partage des propriétés generiques entre classe qui extends de CoreController
	 *
	 */

	public static function share($from, $to) {
		$to->setAction($from->getAction());
		$to->setModule($from->getModule());
		$to->setFormat($from->getFormat());
		
	}
	
	
	/**
	 *	@brief		Methode de verification de l'existance d'une classe
	 *	@details	Methode qui determine si le fichier d'une classe existe
	 *				Selon la regle suivante: les séparateurs type "_" sont les separateurs de dossier: '/'
	 *				puis le tout est ramené en minuscules, puis on cherche l'existance d'abord 
	 *				dans PATH_CORE_CONTROLLER puis dans PATH_CUSTOM_CONTROLLER
	 *
	 *	@return		bool	Renvoi vrai si inclusion reussi et false sinon
	 */
	
	public static function controllerExists($controller) {	
		$path = "";		
		$explode = explode("_",$controller);
		$filename = strtolower(array_pop($explode));
		if (count($explode) > 0) {
			foreach($explode as $ex) {
				$path .= strtolower($ex) . '/';
			}
		}
		if (file_exists(PATH_CORE_CONTROLLER . $path . $filename . '.php')) {
			return true;
		} elseif (file_exists(PATH_CUSTOM_CONTROLLER . $path . $filename . '.php')) {
			return true;
		} else {
			return false;
		}
	}
	

}
