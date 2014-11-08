<?php
class Tool {
	public static function removeLastCharacter($str, $start = 0) {
		return substr ( $str, $start, strlen ( $str ) - 1 );
	}
	public static function getLoginUser() {
		if (isset ( $_COOKIE ['user'] )) {
			return unserialize ( $_COOKIE ['user'] );
		} else {
			header ( "Location:../404.html" );
			die ();
		}
	}
	public static function getLoginUserTypeAdmin() {
		$err = true;
		if (isset ( $_COOKIE ['user'] )) {
			$err = false;
			$log_user = new User ();
			$log_user = unserialize ( $_COOKIE ['user'] );
			if ($log_user->getStatus () == $log_user::STATUS_ADMIN) {
				return $log_user;
			} else {
				$err = true;
			}
		}
		if ($err) {
			header ( "Location:../404.html" );
			die ();
		}
	}
}
?>