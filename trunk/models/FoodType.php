<?php
require_once ("BaseModel.php");

class FoodType extends BaseModel {

	const TABLE = "tbfoodtype";

	private $code;
	private $description;
	
	public function getCode () {
		return $this->code;
	}
	public function setCode ($value) {
		$this->code = $value;
	}
	public function getDescription () {
		return $this->description;
	}
	public function setDescription ($value) {
		$this->description = $value;
	}
	
	public function readDatabase($where = null, $params = null) {
		$this->setSQL ( 'select * from ' . self::TABLE . ' ' . $where );
		$result = $this->excuteRead ( $params );
		$this->prepare ( $result );
		return $result;
	}
	
	public function readDatabaseAll($where = null, $params = null) {
		$this->setSQL ( 'select * from ' . self::TABLE . ' ' . $where );
		$result = $this->excuteRead ( $params );
		return $this->prepareAll ( $result , null);
	}
	
	public function prepare($result) {
		$this->id = $result ['id'];
		$this->code = $result ['code'];
		$this->description = $result ['description'];
		$this->cache = $result ['cache'];
		$this->modifydate = $result ['modifydate'];
		$this->createdate = $result ['createdate'];
		$this->editedby = $result ['editedby'];
	}
	
}