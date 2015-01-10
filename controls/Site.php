<?php
/*
 * Author midmike
 */
require_once ("controls_feature.php");
require_once ("../models/User.php");
require_once ("../models/Site.php");
require_once ("../helper/Tools/Tool.php");
$callfunction = key ( $_GET );
// $values get for paremeter of method
if (isset ( $_GET [$callfunction] )) {
	$values = explode ( ",", $_GET [$callfunction] );
}
if ($values != null) {
	SiteControl::$callfunction ( $values );
} else {
	SiteControl::$callfunction ();
}
die ();
// create class for control
class SiteControl {
	public static function OpenPage() {
		header("Location:../?menu=".PAGE_SITE_CONFIGURE);
		die ();
	}
	public static function Save() {
		$site = new Site(); 
		$site = $site->getSession();
		$log_user = Tool::getLoginUser ();
		if (isset ( $_POST ["language"] ) && ! empty ( $_POST ["language"] )) {
			$site->setlanguage( $_POST ["language"] );
		}
		$site->UpdateDatabase($log_user);
		$site->setSession();
		header("Location:../?menu=".PAGE_SITE_CONFIGURE);
		die ();
	}
	public static function switchLang($value) {
		$site = new Site();
		$site = $site->getSession();
		$site->setlanguage($value[0]);
		$site->setSession();
		$site = $site->getSession();
		header("Location:../");
		die (); 
	}
}
?>