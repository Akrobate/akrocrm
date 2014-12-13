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
	
	public static function fetchArray() {
		return mysql_fetch_array(self::$query_result);
	}

	public static function nbrRows() {
		return mysql_num_rows(self::$query_result);
	}

	public static function lastId() {
		return mysql_insert_id() ;
	}


	public static function escapeString($string) {
		if (self::$connect_handler == null) {
			self::connect();
		}
		return mysql_real_escape_string($string);
	}

	public static function escapeArray($arr) {
		
		
		foreach($arr as $key => $val) {
			if (is_string($val)) {
				$arr[$key] = mysql_real_escape_string($val);
			}
		}
			
		return $arr;
			
	}


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



	public static function peopleTable($name, $params = array()) {
		if (!empty($name)) {
			  
			  $data = "ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur";
			  
			  //dateee date NOT NULL,
			  
			  
			  
			  $ex_data = explode(" ", $data);
			  $count_ex_data = count($ex_data);
			  $count_ex_data_init = $count_ex_data - 3;
			  
			  $nb_val = rand(1,3);
			  $cur_val = rand(1,$count_ex_data_init);
			  
			  $value = "";
			  for($i = $cur_val; $i < $cur_val + $nb_val; $i++) {
			  	$value .= $ex_data[$i] . " ";
			  }
			  
			  $value = trim($value);
			  
			  $data = array();
			 foreach( $params as $fieldname => $val ) {
			 
			 	  $nb_val = rand(1,3);
				  $cur_val = rand(1,$count_ex_data_init);
				  
				  $value = "";
				  for($i = $cur_val; $i < $cur_val + $nb_val; $i++) {
				  	$value .= $ex_data[$i] . " ";
				  }
			 
			 	if ($val['typeSQL'] == 'int') {
					$data[$fieldname] = $value;
			 	} else if ($val['type'] == 'date') {	 
					$data[$fieldname] = $value;
				} else {
					$data[$fieldname] = $value;		
				}
			 }
			  
			return $data;
		}
	}


	public static function removeTable($name) {
		if (!empty($name)) {
			$query = "DROP TABLE IF EXISTS ". $name ." ;";
			self::query($query);
			//echo($query);
			if (self::$display) {
				echo("\n Table de travail : ". $name  ." Supprimée \n\n");
			}
		}
	}


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

	

	public static function display($var) {	
		self::$display = $var;
	}


	public static function peopleTableContacts($name, $params = array()) {

		$str = file_get_contents("http://api.randomuser.me/");
		$obj = json_decode($str);
		$user = $obj->results[0]->user;
		
		if (!empty($name)) {
			$value = "";  
			$data = array();
			foreach( $params as $fieldname => $val ) {
				$data[$fieldname] = $value;		
			}
		}
			  
		$data['nom'] = ucfirst($user->name->last);
		$data['prenom'] = ucfirst($user->name->first);		
		$data['email'] = $user->email;
		$data['adresse'] = $user->location->street;
		$data['ville'] = $user->location->city;
		$data['cp'] = $user->location->zip;
		$data['telephone'] = $user->phone;  
		
		$data['photo'] = $user->picture->large;
		
		return $data;		
	}

}



