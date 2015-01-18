<?php
class Tool {
	/*
	 * Author midmike
	 */
	public static function removeLastCharacter($str, $start = 0) {
		return substr ( $str, $start, strlen ( $str ) - 1 );
	}
	
	public static function getLoginUser() {
		if ( SessionHandlers::isSetSession(User::SESSION_USER)) {
			return SessionHandlers::getObjSession(User::SESSION_USER);
		} else {
			Tool::pageError(User::LOGIN_FAIL);
			die ();
		}
	}
	
	public static function getLoginUserTypeAdmin() {
		$err = true;
		if (SessionHandlers::isSetSession(User::SESSION_USER)) {
			$err = false;
			$log_user = new User ();
			$log_user = SessionHandlers::getObjSession(User::SESSION_USER);
			if ($log_user->getStatus () == $log_user::STATUS_ADMIN) {
				return $log_user;
			} else {
				$err = true;
			}
		}
		if ($err) {
			self::pageError(User::LOGIN_FAIL);
			die ();
		}
	}
	public static function isLoginUserTypeAdmin($log_user) {
		if ($log_user->getStatus () == $log_user::STATUS_ADMIN) {
			return true;
		} else {
			self::pageError(User::LOGIN_FAIL);
			die ();
		}
	}
	
	public static function pageError($typeError=null) {
		//class directories
		$directorys = array(
				'../error.php',
				'error.php',
				'../../error.php',
				'/error.php',
		);
		
		//for each directory
		foreach($directorys as $directory)
		{
			//see if the file exsists
			if(file_exists($directory))
			{	
				die("<script>location.href = '$directory?Type=$typeError'</script>");
				exit();
			}
		}
	}
	
	public static function printSelectOption($name, $arrayValue = null, $arrayText = null, $selectedValue = null, $class = null) {
		echo "<select class='form-control $class' name='$name' >";
		for($i = 0; $i < sizeof ( $arrayValue ); $i ++) {
			  echo "<option value='$arrayValue[$i]'";
			if (strcmp ( $arrayValue[$i] , $selectedValue ) == 0) {
				echo " selected";
			}
			echo ">$arrayText[$i]</option>";  
		}
		echo "</select>";
	}
	public static function isEmpty($value) {
		if ($value == null || $value == "" || $value == 0 ) {
			return true;
		}
		return false;
	}
	public static function encodeObj($obj) {
		return base64_encode( serialize( $obj ) );
	}
	public static function decodeObj($obj) {
		return unserialize( base64_decode( $obj ) );
	}
	public static function getCurrentUrl() {
		return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
	public static function getCurrentHost() {
		return 'http://'.$_SERVER['HTTP_HOST'];
	}
	/* 
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
	} */
}
?>