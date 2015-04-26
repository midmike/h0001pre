<?php
require_once ("BaseModel.php");

class Food extends BaseModel {

	private static $table = "tbfood";
	
	private $name;
	private $price;
	private $status;
	private $image;
	private $thumbnail;
	private $reffoodtype;
	
	public function getName () {
		return $this->name;
	}
	public function setName ($value) {
		$this->name = $value;
	}
	public function getPrice () {
		return $this->price;
	}
	public function setPrice ($value) {
		$this->price = $value;
	}
	public function getStatus () {
		return $this->status;
	}
	public function setStatus ($value) {
		$this->status = $value;
	}
	public function getImage () {
		return $this->image;
	}
	public function setImage ($value) {
		$this->image = $value;
	}
	public function getThumbnail () {
		return $this->thumbnail;
	}
	public function setThumbnail ($value) {
		$this->thumbnail = $value;
	}
	public function getFoodTypeId () {
		return $this->reffoodtype;
	}
	public function setFoodTypeId ($value) {
		$this->reffoodtype = $value;
	}
	
	public function insertDatabase ($user) {
		$user = new User();
		$user->setId(1);
		$this->excuteInsert ( self::$table, get_object_vars ( $this ), $user );
	}
}
?>