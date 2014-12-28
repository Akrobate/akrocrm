<?php

/**
 * @brief		Classe sql permettant de gerer toutes les interaction de base de données
 * @details		surcharge de toutes les méthodes d'acces a la base de données
 *				
 * @author		Artiom FEDOROV
 */

class sql {

	private static $connect_handler = null;
	private static $query_result;
	private static $display = 0; // variable pour le debug	


	/**
	 * @brief		Méthode de connection a la base de données
	 * @details		Se connecte a la base de données selon les constantes
	 *				DB_HOST, DB_USER, DB_PASSWORD
	 *				Le handler est renvoyé et stocké au niveau du singleton
	 * @return	handler		Renvoi le handler de la connection
	 */
	 
	public static function connect() {
		$connect_handler = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		mysql_select_db(DB_NAME, $connect_handler);
		self::$connect_handler = $connect_handler;
		return self::$connect_handler;
	}


	/**
	 * @brief		Méthode d'execution de requetes
	 * @details		Execute la requette 
	 *				DB_HOST, DB_USER, DB_PASSWORD
	 *				Le pointeur de la requete est renvoyé et stocké au niveau du singleton
	 * @return	query_result	Renvoie le resultat de la requette a fetcher
	 */
	 
	public static function query($query, $connect_handler = NULL) {
		if ($connect_handler == null) {
			if (self::$connect_handler == null) {
				self::connect();
			}
			self::$query_result = mysql_query($query, self::$connect_handler);
		} else {
			self::$query_result = mysql_query($query, $connect_handler);
		}
		return self::$query_result;
	}

	
	/**
	 * @brief		Methode qui renvoie tous les resultats de la requete
	 * @details		Fetch l'ensemble de la requete avec la méthode fetch_array
	 * @return	Array	Renvoi tous les résultats de la requete
	 */
	
	public static function allFetchArray() {
		$data = array();
		while ($return = @mysql_fetch_array(self::$query_result)) {
			$data[] = $return;
		}
		return $data;
	}
	
	
	/**
	 * @brief		Methode qui renvoie un resultat de la requete
	 * @details		Fetch de la requete avec la méthode fetch_array
	 * @return	Array	Renvoi le resultat courant de la requete
	 */
	
	public static function fetchArray() {
		return mysql_fetch_array(self::$query_result);
	}


	/**
	 * @brief		Methode qui renvoie le nombre de résultats
	 * @details		nombre de resultats de la requete
	 * @return	int	Renvoi nombre de resultats
	 */
	 
	public static function nbrRows() {
		return mysql_num_rows(self::$query_result);
	}


	/**
	 * @brief		Methode qui renvoie l'id du dernier element inseré
	 * @details		identifiant du dernier enregistrement crée
	 * @return	int	Renvoi l'id
	 */
	 
	public static function lastId() {
		return mysql_insert_id() ;
	}


	/**
	 * @brief		Methode qui echape les chaines de carractere
	 * @details		Pour eviter l'injection sql toutes les données d'UI doivent etre echapés
	 * @param	string	Chaine de carractere a echapper
	 * @return	string	Chaine echappée
	 *
	 */

	public static function escapeString($string) {
		if (self::$connect_handler == null) {
			self::connect();
		}
		return mysql_real_escape_string($string);
	}


	/**
	 * @brief		Methode qui echape les chaines de carractere d'un Array
	 * @details		Pour eviter l'injection sql toutes les données d'UI doivent etre echapés
	 * @param	Array	Tableau contenant des chaines de carractere a echapper
	 * @return	Array	Tableau contenant les chaines echappées
	 *
	 */

	public static function escapeArray($arr) {
		foreach($arr as $key => $val) {
			if (is_string($val)) {
				$arr[$key] = self::escapeString($val);
			}
		}
		return $arr;
	}


	/**
	 * @brief		Methode qui permet la creation d'une table
	 * @details		
	 * @param	name	Nom de la table a creer
	 * @param	params	Array contenant la description a suivre pour la creation de la table
	 */

	public static function createTable($name, $params = array()) {
	
		if (!empty($name)) {
			$query = "CREATE TABLE IF NOT EXISTS ". $name ." (id mediumint(9) NOT NULL AUTO_INCREMENT, ";
			  
			 foreach( $params as $fieldname => $val ) {			 
			 	if ($val['type'] == 'join') {
					 $query .= " $fieldname " . $val['typeSQL'] . " NOT NULL, ";
			 	} else if ($val['type'] == 'date') {	 
				 	$query .= " $fieldname " . $val['typeSQL'] . " NOT NULL, ";
				 } else if ($val['type'] == 'largetext') {	 
				 	$query .= " $fieldname " . $val['typeSQL'] . " NOT NULL, ";
				 } else if ($val['type'] == 'text') {	 
				 	$query .= " $fieldname " . $val['typeSQL'] . " NOT NULL, ";
				 } else {
				 	$query .= " $fieldname " . $val['typeSQL'] . " NOT NULL, ";
				 }
			 }
			  
			 $query .= " PRIMARY KEY (id)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";
			 self::query($query);

			if (self::$display) {
				echo("\n Table de travail : ". $name  ." crée \n\n");
			}
		}	
	}


	/**
	 * @brief		Methode qui supprime une table
	 * @details		Supprime la table name
	 * @param	name	Nom de la table a supprimer
	 */

	public static function removeTable($name) {
		if (!empty($name)) {
			$query = "DROP TABLE IF EXISTS ". $name ." ;";
			self::query($query);
			if (self::$display) {
				echo("\n Table de travail : ". $name  ." Supprimée \n\n");
			}
		}
	}


	/**
	 * @brief		Methode qui ajoute un champ
	 * @details		Ajoute un champ fieldname a la table name de type sql type
	 * @param	table	Nom de la table a alterer
	 * @param	fieldname	Nom du champt a ajouter
 	 * @param	type	type SQL du champ
 	 *
	 */

	public static function addField($table, $fieldname, $type) {	
		if (!empty($table)) {
			$query = " ALTER TABLE $table ADD $fieldname $type ";
			self::query($query);
			//echo($query);
			if (self::$display) {
				echo("\n Champ $fieldname Ajouté : dans la table $table \n\n");
			}
		}
	}
	
	
	/**
	 * @brief		Verifie l'existance d'une table
	 * @details		Verifie si la table table exists renvoi true si oui else sinon
	 * @param	table	nom de la table a verifier
 	 * @return	bool	Renvoi true si table existe false sinon
 	 *
	 */
	
	public static function tableExists($table) {	
		if (!empty($table)) {
			$query = " SHOW TABLES FROM " . DB_NAME . " LIKE '".$table."' ";
			self::query($query);
			$nb = self::nbrRows();
			//echo($query);
			if ($nb > 0) {
				return true;
			} else {
				return false;
			}
		}
	}


	/**
	 * @brief		Permet d'afficher le debug
	 * @details		Peut s'averer utile pour les methodes de build
	 * @param	var	active desactive
 	 *
	 */

	public static function display($var) {	
		self::$display = $var;
	}




}



