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
	UserControl::$callfunction ( $values );
} else {
	UserControl::$callfunction ();
}
die ();
// create class for control
class UserControl {
	public Static function login() {
		$user = new User ();
		if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
			$user->setUsername ( $_POST ["username"] );
			// echo $user->getUserName();
		} else {
			$_POST [User::LOGIN_EVENT] = User::LOGIN_NO_USERNAME;
		}
		if (isset ( $_POST ["password"] ) && ! empty ( $_POST ["password"] )) {
			$user->setPassword ( $_POST ["password"] );
			// echo $user->getPassword();
		} else {
			$_POST [User::LOGIN_EVENT] = User::LOGIN_NO_PASSWORD;
		}
		if (isset ( $_POST ["rememberme"] ) && ! empty ( $_POST ["rememberme"] )) {
			if ($_POST ["rememberme"] == "true") {
				setcookie ( User::SESSION_USER, Tool::encodeObj ( $user ), time () + (900), "/" ); // 900s = 15m
			}
		}
		SessionHandlers::saveSession ( $user, 'log_user' );
		header ( "Location:../" );
		exit ();
		/*
		 * if ($user->isLogin()) {
		 * //header ( "Location:../" );
		 * } else {
		 * //header("Location:../?fail");
		 * }
		 */
	}
	public Static function Logout() {
		SessionHandlers::destroyAllSession (); /*
		                                       * header("Location:".dirname(__FILE__));
		                                       */
		unset ( $_COOKIE [User::SESSION_USER] );
		setcookie ( User::SESSION_USER, null, - 1, '/' );
		header ( "Location:../" );
		exit ();
	}
	public Static function Create() {
		$log_user = Tool::getLoginUser ();
		$user = new User ();
		if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
			$user->setUsername ( $_POST ["username"] );
		} else {
			Tool::pageError ();
		}
		if (isset ( $_POST ["password"] ) && ! empty ( $_POST ["password"] )) {
			$user->setPassword ( $_POST ["password"] );
		} else {
			Tool::pageError ();
		}
		if (isset ( $_POST ["name"] ) && ! empty ( $_POST ["name"] )) {
			$user->setName ( $_POST ["name"] );
		}
		if (isset ( $_POST ["status"] ) && ! empty ( $_POST ["status"] )) {
			$user->setStatus ( $_POST ["status"] );
		}
		if (isset ( $_POST ["address"] ) && ! empty ( $_POST ["address"] )) {
			$user->setAddress ( $_POST ["address"] );
		}
		if (isset ( $_POST ["phone"] ) && ! empty ( $_POST ["phone"] )) {
			$user->setPhone ( $_POST ["phone"] );
		}
		if (isset ( $_POST ["cache"] ) && ! empty ( $_POST ["cache"] )) {
			if ($_POST ["cache"] == User::CACHE_HIDE) {
				$user->setCache ( User::CACHE_HIDE );
			} else {
				$user->setCache ( User::CACHE_SHOW );
			}
		}
		$user->insertDatabase ( $log_user );
		header ( "Location:../?menu=" . PAGE_MANAGE_USER );
		exit ();
	}
	public Static function Edit() {
		$log_user = Tool::getLoginUser ();
		try {
			$user = new User ();
			if (isset ( $_POST ["id"] ) && ! empty ( $_POST ["id"] )) {
				$user->setId ( $_POST ["id"] );
			}
			if (isset ( $_POST ["cache"] ) && ! empty ( $_POST ["cache"] )) {
				$user->setCache ( $_POST ["cache"] );
			}
			if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
				$user->setUsername ( $_POST ["username"] );
			} else {
				Tool::pageError ();
			}
			if (isset ( $_POST ["password"] ) && ! empty ( $_POST ["password"] )) {
				$user->setPassword ( $_POST ["password"] );
			} else {
				Tool::pageError ();
			}
			if (isset ( $_POST ["name"] ) && ! empty ( $_POST ["name"] )) {
				$user->setName ( $_POST ["name"] );
			}
			if (isset ( $_POST ["status"] ) && ! empty ( $_POST ["status"] )) {
				$user->setStatus ( $_POST ["status"] );
			}
			if (isset ( $_POST ["address"] ) && ! empty ( $_POST ["address"] )) {
				$user->setAddress ( $_POST ["address"] );
			}
			if (isset ( $_POST ["phone"] ) && ! empty ( $_POST ["phone"] )) {
				$user->setPhone ( $_POST ["phone"] );
			}
			if (isset ( $_POST ["cache"] ) && ! empty ( $_POST ["cache"] )) {
				if ($_POST ["cache"] == User::CACHE_HIDE) {
					$user->setCache ( User::CACHE_HIDE );
				} else {
					$user->setCache ( User::CACHE_SHOW );
				}
			}
			$user->UpdateDatabase ( $log_user );
			header ( "Location:../?menu=" . PAGE_MANAGE_USER );
			exit ();
		} catch ( Exception $e ) {
			echo 'Caught exception: ', $e->getMessage (), "\n";
			// header("Location:../404.html");
		}
	}
	public Static function Page($array) {
		$log_user = Tool::getLoginUser ();
		if ($array [0] == CREATE) {
			header ( "Location:../?menu=" . PAGE_MANAGE_USER . "&" . VIEW . "=" . CREATE );
		} elseif ($array [0] == EDIT) {
			$user = new User ();
			$user->setId ( $_GET ['id'] );
			$user->readDatabase ();
			SessionHandlers::saveSession ( $user, 'edit_user' );
			header ( "Location:../?menu=" . PAGE_MANAGE_USER . "&" . VIEW . "=" . EDIT );
		} elseif ($array [0] == SHOWHIDE) {
			header ( "Location:../?menu=" . PAGE_MANAGE_USER . "&cache=" . $_GET ['cache'] );
		} elseif ($array [0] == REFRESH) {
			header ( "Location:../?menu=" . PAGE_MANAGE_USER );
		} else {
			echo "page not found";
		}
		exit ();
	}
	public Static function UserNameValidate() {
		$log_user = Tool::getLoginUser ();
		header ( 'Content-type: application/json' );
		echo json_encode ( array (
				'valid' => true 
		) );
		return true;
	}
	/*
	 * public static function CreateTest() {
	 * $user = new User ();
	 * $user->createUserTest();
	 *
	 * for($i=0;$i<=1000;$i++) {
	 * $user->executeNonReturn();
	 * }
	 * }
	 */
}

?>