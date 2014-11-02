<?php
class BaseModel {
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
		$result = DatabaseHandler::GetRow ( $result, $params );
		return $result;
	}
	public function excuteUpdate($tablename = null, $obj, User $user) {
		$obj_in_array = $obj;
		$prepareparams = "";
		$fieldsname = "";
		$values = array ();
		$today = date ( 'Y-m-d' );
		$id = $obj_in_array ['id'];
		$obj_in_array ['createdate'] = $today;
		$obj_in_array ['editedby'] = $user->getId ();
		$obj_in_array ['cache'] = "0";
		foreach ( $obj_in_array as $key => $value ) {
			$prepareparams = $prepareparams . "?,";
			$fieldsname = $fieldsname . $key . ",";
			array_push ( $values, $value );
		}
		array_push ( $values, $id );
		$fieldsname = Tool::removeLastCharacter ( $fieldsname );
		$this->sql = "UPDATE `$tablename` SET($fieldsname) VALUES ($prepareparams) WHERE id=?;";
		$result = DatabaseHandler::Prepare ( $this->sql );
		DatabaseHandler::GetInsert ( $result, $values );
	}
	public function excuteInsert($tablename = null, $obj, User $user) {
		$obj_in_array = $obj;
		$prepareparams = "";
		$fieldsname = "";
		$values = array ();
		$today = date ( 'Y-m-d' );
		$obj_in_array ['createdate'] = $today;
		$obj_in_array ['editedby'] = $user->getId ();
		$obj_in_array ['createdate'] = $today;
		$obj_in_array ['cache'] = "0";
		foreach ( $obj_in_array as $key => $value ) {
			$prepareparams = $prepareparams . "?,";
			$fieldsname = $fieldsname . $key . ",";
			array_push ( $values, $value );
		}
		$prepareparams = Tool::removeLastCharacter ( $prepareparams );
		$fieldsname = Tool::removeLastCharacter ( $fieldsname );
		$this->sql = "INSERT INTO `$tablename` ($fieldsname) VALUES ($prepareparams);";
		$result = DatabaseHandler::Prepare ( $this->sql );
		DatabaseHandler::GetInsert ( $result, $values );
	}
	public function prepareAll($result, $obj) {
		$allRows = new ArrayObject ();
		while ( $result ) {
			$this->prepare ( $result );
			$allRows . append ( $this );
		}
		return $allRows;
	}
}
?>