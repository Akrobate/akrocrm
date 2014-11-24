<?php

class users {

	private static $connected = null;
	
	public static function connectOld($login, $pw) {
	
		if( (ADMIN_LOGIN == $login) && (ADMIN_PASSWORD == $pw)) {		
			self::$connected = true;
			$_SESSION['user']['connected'] = true;
			return true;
		} else {
			self::$connected = false;
			$_SESSION['user']['connected'] = false;
			unset($_SESSION);
			return false;
		}
		
	}
	
	
	
	public static function issetId() {
		return isset($_SESSION['user']['id']);
	}
	
	
	
	public static function getId() {
		return $_SESSION['user']['id'];
	}
	
	public static function connect($login, $pw) {
		
		if( (ADMIN_LOGIN == $login) && (ADMIN_PASSWORD == $pw)) {		
			self::$connected = true;
			$_SESSION['user']['connected'] = true;
			return true;
		} else {
			// verification si l'utilisateur existe en base.
			sql::query("SELECT * FROM users WHERE login='".$login."' AND password='".$pw."'");
			if ($user = sql::fetchArray()) {
				self::$connected = true;
				$_SESSION['user']['connected'] = true;
				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['login'] = $user['login'];
				return true;
			} else {
				self::$connected = false;
				unset($_SESSION);
				return false;	
			}
		}
	}	
		
		
		
		
	

	public static function logout() {
		unset($_SESSION['user']);
		self::$connected = false;
		return true;
	}

	public static function isConnected() {
	
		if (@$_SESSION['user']['connected'] == true) {
			self::$connected = true;
			return true;
		} else {
			self::$connected = false;
			return false;
		}	
	}
}


?>
