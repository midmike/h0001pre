<?php
/*
 * Author midmike
 */
class SessionHandlers {
	public static function checkSession() {
		if (session_status () == PHP_SESSION_NONE) {
			session_start ();
			session_regenerate_id ( true );
			// echo "Session start<br>";
			return true;
		}
		// echo "Session already start<br>";
		return false;
	}
	public static function destroyAllSession() {
		self::checkSession ();
		// Unset all of the session variables.
		$_SESSION = array ();
		
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get ( "session.use_cookies" )) {
			$params = session_get_cookie_params ();
			setcookie ( session_name (), '', time () - 42000, $params ["path"], $params ["domain"], $params ["secure"], $params ["httponly"] );
		}
		
		// Finally, destroy the session.
		session_destroy ();
	}
	public static function destroySession($sessionName) {
		unset ( $_SESSION [$sessionName] );
		// echo "run destroy session by name<br>";
	}
	public static function configSession() {
	}
	public static function isSetSession($sessionName) {
		self::checkSession ();
		if (isset ( $_SESSION [$sessionName] ) && $_SESSION [$sessionName] != '') {
			return true;
		} else {
			return false;
		}
	}
	public static function saveSession($objSave, $sessionName) {
		self::checkSession ();
		$_SESSION [$sessionName] = serialize ( $objSave );
		// echo "Object saved in Session";
	}
	public static function getObjSession($sessionName) {
		self::checkSession ();
		return unserialize ( $_SESSION [$sessionName] );
	}
}
?>