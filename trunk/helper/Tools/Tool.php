<?php
class Tool {
	public static function removeLastCharacter($str, $start = 0) {
		return substr ( $str, $start, strlen ( $str ) - 1 );
	}
	public static function getLoginUser(){
		if (isset($_COOKIE ['user'])){
			return unserialize ( $_COOKIE ['user'] );
		} else {
			return false;
		}
	}
}
?>