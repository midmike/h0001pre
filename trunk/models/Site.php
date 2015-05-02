<?php

define ( "PAGE_USER_REGISTER", "1" );
define ( "PAGE_FOOD", "2" );
define ( "PAGE_MANAGE_USER", "3" );
define ( "PAGE_SITE_CONFIGURE", "4" );

define ( "VIEW", "View");
define ( "CREATE", "Create" );
define ( "PAGE", "Page" );
define ( "EDIT", "Edit" );
define ( "SHOWHIDE", "ShowHide" );
define ( "FRAME","frame");
define ( "REFRESH", "Refresh" );
require_once ("BaseModel.php");
class Site extends BaseModel{
	const TABLENAME = "tbsite";
	const SESSIONNAME = "usersite";
	private $language;
	private $refuser;
	    
	public function getrefUser() 
	{
	  return $this->refuser;
	}
	
	public function setrefUser($value) 
	{
	  $this->refuser = $value;
	}
	    
	public function getlanguage() 
	{
	  return $this->language;
	}
	
	public function setlanguage($value) 
	{
	  $this->language = $value;
	}
	
	public function readDatabase($where = null, $params = null) {
		if($where == null ) {
			if (!Tool::isEmpty(self::getId())) {
				$where = "where id =".self::getId();
			}
		}
		$this->setSQL ( 'select * from ' . self::TABLENAME . $where );
		$result = $this->excuteRead ( $params );
		$this->prepare ( $result );
		//return $result;
	}
	
	public function readDatabaseAll($where = null, $params = null) {
		$this->setSQL ( 'select * from ' . self::TABLENAME . $where );
		$result = $this->excuteReadAll ();
		return $this->prepareAll ( $result , "Site" );
	}
	
	public function insertDatabase($user) {
		$this->excuteInsert ( self::TABLENAME, get_object_vars ( $this ), $user );
	}
	
	public function UpdateDatabase($user) {
		$this->excuteUpdate ( self::TABLENAME, $this->prepareUpdate() , $user );
	}
	
	private function prepareUpdate() {
		$sqlData = "`language` = '".$this->getlanguage()."',`cache` = b'".$this->getCache()."'";
		return $sqlData;
	}
	
	public function prepare($result) {
		$this->prepareBase($result);
		$this->setlanguage($result['language']);
		$this->setrefUser($result['refuser']);
	}
	public function isExist($user) {
		$this->setrefUser($user->getId());
		$this->readDatabase(" where refuser = " . $this->getrefUser());
		
		if($this->getlanguage() != null) {
			return true;
		} else {
			return false;
		}
	}
	public function isSetSession() {
		return SessionHandlers::isSetSession(self::SESSIONNAME);
	}
	public function setSession() {
		SessionHandlers::saveSession($this, self::SESSIONNAME);
	}
	public function readDatabaseByUser() {
		if (!Tool::isEmpty($this->getrefUser())) {
			$where = " where refuser = ".$this->getrefUser();
		} else {
			return;
		}
		$this->setSQL ( 'select * from ' . self::TABLENAME . $where );
		$result = $this->excuteRead ();
		$this->prepare ( $result );
		//return $result;
	}
	public function setSessionByUser() {
		$this->readDatabaseByUser();
		$this->setSession();
	}
	public function getSession() {
		return SessionHandlers::getObjSession(self::SESSIONNAME);
	}
}

?>