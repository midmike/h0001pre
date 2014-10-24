<?php
class BaseModel {
	protected $sql = "";
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
	protected function setSQL($sql) {
		$this->sql = $sql;
	}
	public function excuteRead($params = null) {
		$result = DatabaseHandler::Prepare ( $this->sql );
		$result = DatabaseHandler::GetRow( $result, $params );
		return $result;
	}
	public function excuteUpdate($where = null, $params = null) {
		//still not done with it yet
		$sql = $this->sql . "" . $where;
		$result = DatabaseHandler::Prepare ( $sql );
		$result = DatabaseHandler::GetInsert ( $result, $params );
	}
	public function excuteInsert($tablename = null, $fieldsname = null, $params, $user) {
		$prepareparams = "?";
		for($i = 1; $i < count ( $params ) + 4; $i ++) {
			$prepareparams = $prepareparams . ",?";
		}
		$fieldsname = $fieldsname . ",createdate,modifydate,editedby,cache";
		$today = date ( 'Y-m-d' );
		array_push ( $params, $today, $today, $user->getId (), "0" );
		$this->sql = "INSERT INTO `$tablename` ($fieldsname) VALUES ($prepareparams);";
		$result = DatabaseHandler::Prepare ( $this->sql );
		DatabaseHandler::GetInsert ( $result, $params );
	}
}
?>