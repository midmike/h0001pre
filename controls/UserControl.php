<?php
require_once ("controls_feature.php");
require_once ("../models/User.php");
$callfunction = key ( $_GET );
// $values get for paremeter of method
if (isset ( $_GET ['$callfunction'] )) {
	$values = explode ( ",", $_GET ['$callfunction'] );
}

UserControl::$callfunction ();

// create class for control
class UserControl {
	public Static function login() {
		$user = new User ();
		if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
			$user->setUsername ( $_POST ["username"] );
			// echo $user->getUserName();
		}
		if (isset ( $_POST ["password"] ) && ! empty ( $_POST ["password"] )) {
			$user->setPassword ( $_POST ["password"] );
			// echo $user->getPassword();
		}
		if ($user->isExist ()) {
			header ( "Location:../" );
		} else {
			// / header("Location:../?fail");
		}
		die ();
	}
	public Static function Logout() {
	}
	public Static function Create() {
		$log_user = Tool::getLoginUser ();
		$user = new User ();
		if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
			$user->setUsername ( $_POST ["username"] );
		}
		if (isset ( $_POST ["password"] ) && ! empty ( $_POST ["password"] )) {
			$user->setPassword ( $_POST ["password"] );
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
		$user->insertDatabase ( $log_user );
		// header("Location:../");
	}
	public Static function Update() {
		$log_user = Tool::getLoginUser ();
		if ($log_user == false) {
			header ( "Location:../404.html" );
			die ();
		}
		try {
			$user = new User ();
			if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
				$user->setId ( $_POST ["id"] );
			}
			if (isset ( $_POST ["username"] ) && ! empty ( $_POST ["username"] )) {
				$user->setUsername ( $_POST ["username"] );
			}
			if (isset ( $_POST ["password"] ) && ! empty ( $_POST ["password"] )) {
				$user->setPassword ( $_POST ["password"] );
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
		} catch ( Exception $e ) {
			echo 'Caught exception: ', $e->getMessage (), "\n";
			// header("Location:../404.html");
		}
		
		$user->UpdateDatabase ( $user );
	}
}

?>