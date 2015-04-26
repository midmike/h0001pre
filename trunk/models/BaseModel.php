<?php
class BaseModel {
	//cache status
	const CACHE_HIDE = "1";
	const CACHE_SHOW = "0";
	
	private $sql = "";
	protected $id;
	protected $createdate;
	protected $modifydate;
	protected $editedby;
	protected $cache;
	public function getCache() {
		return $this->cache;
	}
	public function setCache($value) {
		$this->cache = $value;
	}
	public function getEditedby() {
		return $this->editedby;
	}
	public function setEditedby($value) {
		$this->editedby = $value;
	}
	public function getModifydate() {
		return $this->modifydate;
	}
	public function setModifydate($value) {
		$this->modifydate = $value;
	}
	public function getCreatedate() {
		return $this->createdate;
	}
	public function setCreatedate($value) {
		$this->createdate = $value;
	}
	public function setId($value) {
		$this->id = $value;
	}
	public function getId() {
		return $this->id;
	}
	protected function setSQL($sql) {
		$this->sql = $sql;
	}
	public function excuteRead($params = null) {
		$result = DatabaseHandler::Prepare ( $this->sql );
		//echo $this->sql."<br/>";
		$result = DatabaseHandler::GetRow ( $result, $params );
		return $result;
	}
	public function excuteReadAll($params = null) {
		$result = DatabaseHandler::Prepare ( $this->sql );
		$result = DatabaseHandler::GetAll ( $result, $params );
		return $result;
	}
	public function excuteUpdate($tablename = null, $sqlData, User $user) {
		$modifydate = date ( 'Y-m-d' );
		$editedby = $user->getId (); 
		$id = $this->id;
		$this->sql = "UPDATE `$tablename` SET ". $sqlData. ", editedby = '$editedby', modifydate= '$modifydate' "." WHERE id=".$id.";";
		$result = DatabaseHandler::Prepare ( $this->sql );
		echo $this->sql."<br/>";
		DatabaseHandler::GetInsert ( $result );
	}
	public function excuteInsert($tablename = null, $obj, User $user) {
		$obj_in_array = $obj;
		$prepareparams = "";
		$fieldsname = "";
		$values = array ();
		$today = date ( 'Y-m-d' );
		$obj_in_array ['createdate'] = $today;
		$obj_in_array ['editedby'] = $user->getId ();
		$obj_in_array ['modifydate'] = $today;
		$obj_in_array ['cache'] = self::CACHE_SHOW;
		$this->prepareArray($prepareparams,$fieldsname,$values,$obj_in_array);
		$prepareparams = Tool::removeLastCharacter ( $prepareparams );
		$fieldsname = Tool::removeLastCharacter ( $fieldsname );
		$this->sql = "INSERT INTO `$tablename` ($fieldsname) VALUES ($prepareparams);";
		//echo $this->sql;
		//print_r($values);
		$result = DatabaseHandler::Prepare ( $this->sql );
		DatabaseHandler::GetInsert ( $result, $values );
	}
	public function prepareAll($result, $className) {
		$allRows = new ArrayObject ();
		foreach ($result as $value ) {
			$obj = new $className();
			$obj->prepare ( $value );
			$allRows->append ( $obj );
		} 
		return $allRows;
	}
	public function prepareBase($result) {
		$this->id = $result ['id'];
		$this->cache = $result ['cache'];
		$this->modifydate = $result ['modifydate'];
		$this->createdate = $result ['createdate'];
		$this->editedby = $result ['editedby'];
	}
	public function prepareArray(&$prepareparams,&$fieldsname,&$values,&$obj_in_array) {
		foreach ( $obj_in_array as $key => $value ) {
			if ( $key == "dbpassword" || $key =="id") {
				continue;
			}
			$prepareparams = $prepareparams . "?,";
			$fieldsname = $fieldsname . $key . ",";
			array_push ( $values, $value );
		}
	}
	private function prepareUpdate(&$values,&$obj_in_array) {
		$setFieldVaule = "";
		foreach ( $obj_in_array as $key => $value ) {
			if ( $key == "dbpassword" || $key == "cache" || $key == "createdate") {
				continue;
			}
			if ($key == "id") {
				$id = $value;
				continue;
			}
			$setFieldVaule = $setFieldVaule.$key . " = ".$value.", ";
			//array_push ( $values, $value );
		}
		//array_push ( $values, $id );
		$setFieldVaule = Tool::removeLastCharacter ( $setFieldVaule );
		$setFieldVaule = Tool::removeLastCharacter ( $setFieldVaule );
		return $setFieldVaule;
	}
	public function executeReturn() {
		$result = DatabaseHandler::Prepare ( $this->sql );
		$result = DatabaseHandler::GetRow ( $result );
		return $result;
	}
	public function executeNonReturn() {
		$result = DatabaseHandler::Prepare ( $this->sql );
		DatabaseHandler::GetInsert ( $result );
	}
	public function TestSql($sql) {
		$this->sql=$sql;
	}
}
?>