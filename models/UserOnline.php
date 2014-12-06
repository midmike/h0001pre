<?php
require_once ("BaseModel.php");

/*
 * Author midmike
 */
class UserOnline extends BaseModel {
	const TABLENAME = "tbuseronline";
	private $time;
	private $session;
	private $refuser;
	    
	public function getrefuser() 
	{
	  return $this->refuser;
	}
	
	public function setrefuser($value) 
	{
	  $this->refuser = $value;
	}
	    
	public function getsession() 
	{
	  return $this->session;
	}
	
	public function setsession($value) 
	{
	  $this->session = $value;
	}    
	public function gettime() 
	{
	  return $this->time;
	}
	
	public function settime($value) 
	{
	  $this->time = $value;
	}
	
	public function prepare($result) {
		$this->id = $result ['id'];
		$this->refuser = $result ['refuser'];
		$this->session = $result ['session'];
		$this->time = $result ['time'];
		$this->cache = $result ['cache'];
		$this->modifydate = $result ['modifydate'];
		$this->createdate = $result ['createdate'];
		$this->editedby = $result ['editedby'];
	}
	public function readDatabase($where = null, $params = null) {
		$this->setSQL ( 'select * from '.self::TABLENAME. " " . $where );
		$result = $this->excuteRead ( $params );
		$this->prepare ( $result );
		return $result;
	}
	public function readDatabaseAll($where = null, $params = null) {
		$this->setSQL ( 'select * from '.self::TABLENAME. " " . $where );
		$result = $this->excuteRead ( null, $params );
		return $this->prepareAll ( $result );
	}
	public function insertDatabase($user) {
		$this->excuteInsert ( self::TABLENAME, get_object_vars ( $this ), $user );
	}
	public function UpdateDatabase($user) {
		$options = [
				'cost' => 12
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteUpdate ( "tbuser", get_object_vars ( $this ), $user );
	}
}
?>