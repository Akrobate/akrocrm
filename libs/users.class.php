<?php

class users {

	private static $connected = null;
	public static $me = array();
	public static $profile = array();
	
	
	
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
	
//				$_SESSION['user']['id'] = $user['id'];
//				$_SESSION['user']['login'] = $user['login'];
				self::$me = $user;
				$_SESSION['user'] = self::$me;
				$_SESSION['user']['connected'] = true;
				
				self::getProfile();
				
			
				return true;
				
			} else {
				self::$connected = false;
				unset($_SESSION['user']);
				unset($_SESSION['profile']);
				return false;	
			}
		}
	}
	
		
	public static function getMe() {
	
		if (isset($_SESSION['user'])) {
			self::$me = $_SESSION['user'];
		}
		return self::$me;
	}
	
	
	public static function getProfile() {
	
		if (isset($_SESSION['profile'])) {
			self::$profile = $_SESSION['profile'];
		
		} else {
			self::loadProfile();
		}
	
		return self::$profile;
	
	}


		
	
	public static function loadProfile() {
		
		if(self::$connected == true) {
			
			if( (self::$me['login'] == ADMIN_LOGIN)) {		
		

			} else {
				sql::query("SELECT * FROM profiles WHERE id = " . self::$me['id_profil'] );
				if ($profile = sql::fetchArray()) {
					
					eval($profile['view']);
					self::$profile['view'] = $view;
					$_SESSION['profile'] = self::$profile;
				} else {
				
				}
			}
		}
	}	
		
	

	public static function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['profile']);
		self::$connected = false;
		return true;
	}


	public static function isConnected() {
	
		if (@$_SESSION['user']['connected'] == true) {
			self::$connected = true;
			return true;
		} else {
			self::$connected = false;
			return self::tryToConnect();
			//return false;
		}
			
	}
	
	
	
	public static function tryToConnect() {
		
		$login = request::get('login');
		$password = request::get('password');
		
		if (($login != "") && ( $password != "" )) {
			if (users::connect($login, $password)) {
				return true;	
			}
		}
		
		return false;
	}
	
}


?>
