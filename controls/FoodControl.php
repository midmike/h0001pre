<?php
require_once ("controls_feature.php");
require_once ("../models/User.php");
require_once ("../helper/Uploader.php");
require_once ("../models/Food.php");
require_once ("../helper/ImageSizer.php");
require_once ("../models/Site.php");
$callfunction = key ( $_GET );
// $values get for paremeter of method
if (isset ( $_GET [$callfunction] )) {
	$values = explode ( ",", $_GET [$callfunction] );
}
if ($values != null) {
	FoodControl::$callfunction ( $values );
} else {
	FoodControl::$callfunction ();
}
class FoodControl {

	private static $tmpDir = "../assets/upload/tmp/";
	private static $thumDir = "../assets/upload/thumbnail/";
	private static $imageDir = "../assets/upload/images/";
	
	public static function uploadImage() {
		$allowFile = array("image/jpeg", "image/png", "image/gif");
		$df = "Ymd-H-i-s";
		$fileName = "TMPIMG" . date($df) . "." . Uploader::getExtension();
		
		if (!Uploader::getTempFile()) {
			$result['error'] = true;
			$result['message'] = 'Please browse for a file!';
			echo json_encode($result);
			return;
		}
		if (!in_array(Uploader::getType() , $allowFile)) {
			$result['error'] = true;
			$result['message'] = 'Please choose only image file (jpg, png or gif)!';
			echo json_encode($result);
			return;
		}
		
		if (Uploader::moveUploadFileTo(self::$tmpDir, $fileName)) {
			$result['error'] = false;
			$result['message'] = 'File upload succeeded!';
			$result['image'] = 'assets/upload/tmp/' . $fileName;
			$result['alt'] = $fileName;
		} else {
			$result['error'] = true;
			$result['message'] = 'Fail in moving file upload!';
		}
		echo json_encode($result);
	}
	
	public static function create () {
		$foodData = json_decode($_POST["foodData"], true);
		$result = array();
		
		$validate = true;
		$result["foodName"] = false;
		$result["foodPrice"] = false;
		$result["foodType"] = false;
		if (!isset($foodData["foodName"]) || empty($foodData["foodName"])) {
			$result['foodName'] = true;
			$validate = false;
		}
		if (!isset($foodData["foodPrice"]) || empty($foodData["foodPrice"])) {
			$result['foodPrice'] = true;
			$validate = false;
		}
		if (!isset($foodData["foodType"]) || empty($foodData["foodType"])) {
			$result['foodType'] = true;
			$validate = false;
		}
		if (!isset($foodData["image"]) || empty($foodData["image"])) {
			$result['image'] = true;
			$validate = false;
		}
		
		if ($validate == false) {
			echo json_encode($result);
			return;
		}
		
		$x = $y = 0;
		$s = 250;
		$d = 100;
		
		$sizer = new ImageSizer();
		$sizer->load(self::$tmpDir . $foodData["image"]);
		$width = $sizer->getWidth();
		$height = $sizer->getHeight();
		$sizer->save(self::$imageDir . $foodData["image"]);
		$x = $width * ($foodData["cropX"] / $foodData["imageW"]);
		//echo $width." ".$foodData["cropX"]." ".$x."<br>";
		$y = $height * ($foodData["cropY"] / $foodData["imageH"]);
		//echo $height." ".$foodData["cropY"]." ".$y."<br>";
		$d = $width * ($foodData["cropW"] / $foodData["imageW"]);
		//echo $foodData["cropW"]." ".$d;
		if(intval($d) != 0) {
			$sizer->resize($x, $y, $s, $d);
			$sizer->save(self::$thumDir . $foodData["image"]);
		}
		$food = new Food();
		$food->setName($foodData["foodName"]);
		$food->setPrice($foodData["foodPrice"]);
		$food->setFoodTypeId(1);
		$food->setStatus(true);
		$food->setThumbnail($foodData["image"]);
		$food->setImage($foodData["image"]);
		$food->insertDatabase(null);
		
		echo json_encode($result);
	}
	public Static function Page($array) {
		$log_user = Tool::getLoginUser ();
		if ($array [0] == CREATE) {
			header ( "Location:../?menu=" . PAGE_FOOD . "&" . VIEW . "=" . CREATE );
		} elseif ($array [0] == EDIT) {
			$food = new Food();
			$food->setId ( $_GET ['id'] );
			$food->readDatabase ();
			SessionHandlers::saveSession ( $user, 'edit_food' );
			header ( "Location:../?menu=" . PAGE_FOOD . "&" . VIEW . "=" . EDIT );
		} elseif ($array [0] == SHOWHIDE) {
			header ( "Location:../?menu=" . PAGE_FOOD . "&cache=" . $_GET ['cache'] );
		} elseif ($array [0] == REFRESH) {
			header ( "Location:../?menu=" . PAGE_FOOD );
		} elseif ($array [0] == FRAME) {
			$food = new Food();
			//print_r($food->readDatabaseAll ());
			SessionHandlers::saveSession ( $food->readDatabaseAll (), 'foodList' );
			header ( "Location:../?menu=" . PAGE_FOOD . "&" . VIEW . "=" . FRAME );
		} 
		else {
			echo "page not found";
		}
		exit ();
	}
}