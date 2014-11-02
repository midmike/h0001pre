<?php
require_once ("BaseModel.php");
/*
 * Author midmike
 */
class User extends BaseModel {
	private $name;
	private $status;
	private $address;
	private $phone;
	private $username;
	private $password;
	public function setUsername($value) {
		$this->username = $value;
	}
	public function setPassword($value) {
		$this->password = $value;
	}
	public function setStatus($value) {
		$this->status = $value;
	}
	public function setAddress($value) {
		$this->address = $value;
	}
	public function setPhone($value) {
		$this->phone = $value;
	}
	public function setName($value) {
		$this->name = $value;
	}
	public function getId() {
		return $this->id;
	}
	public function getUserName() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function readDatabase($where = null, $params = null) {
		$this->setSQL ( 'select * from tbuser ' . $where );
		$result = $this->excuteRead ( $params );
		$this->prepare ( $result );
		return $result;
	}
	public function readDatabaseAll($where = null, $params = null) {
		$this->setSQL ( 'select * from tbuser ' . $where );
		$result = $this->excuteRead ( null, $params );
		return $this->prepareAll ( $result );
	}
	public function insertDatabase($user) {
		$options = [ 
				'cost' => 12 
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteInsert ( "tbuser", get_object_vars ($this), $user );
	}
	public function UpdateDatabase($user){
		$options = [
				'cost' => 12
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteUpdate( "tbuser", get_object_vars ($this), $user );
	}
	public function isExist() {
		$username = $this->username;
		$password = $this->password;
		// return to result to check name have in record or not
		$result = $this->readDatabase ( 'where username = ?', array (
				$username 
		) );
		if (! empty ( $result )) {
			if ($this->username == $username && password_verify ( $password, $this->password )) {
				setcookie ( 'user', serialize ( $this ), time () + (900), "/" ); // 900s = 15m
				                                                                 // echo "add cookies";
				return TRUE; // true
			}
			echo "password incorrect";
			return FALSE; // false
		} else {
			echo "\$result empty in isExist()";
			return FALSE; // false
		}
	}
	public function isLogin() {
		if (isset ( $_COOKIE ['user'] )) {
			$user = unserialize ( $_COOKIE ['user'] );
			setcookie ( 'user', serialize ( $user ), time () + (900), "/" );
			// echo "islogin:true<br>";
			return TRUE; // $user->isExist();
		}
		// echo "islogin:false<br>";
		return FALSE;
	}
	public function prepare($result) {
		$this->id = $result ['id'];
		$this->name = $result ['name'];
		$this->status = $result ['status'];
		$this->address = $result ['address'];
		$this->password = $result ['password'];
		$this->username = $result ['username'];
		$this->cache = $result ['cache'];
		$this->modifydate = $result ['modifydate'];
		$this->createdate = $result ['createdate'];
		$this->editedby = $result ['editedby'];
	}
}
?>