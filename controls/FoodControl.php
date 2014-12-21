<?php
require_once ("controls_feature.php");
require_once ("../models/User.php");
require_once ("../helper/Uploader.php");
require_once ("../models/Food.php");
require_once ("../helper/ImageSizer.php");
$callfunction = key ( $_GET );
// $values get for paremeter of method
if (isset ( $_GET ['$callfunction'] )) {
	$values = explode ( ",", $_GET ['$callfunction'] );
}

FoodControl::$callfunction ();

class FoodControl {

	private static $tmpDir = "../assets/upload/tmp/";
	private static $thumDir = "../assets/upload/thumbnail/";
	
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
		$result["foodCode"] = false;
		$result["foodName"] = false;
		$result["foodPrice"] = false;
		$result["foodType"] = false;
		
		if (!isset($foodData["foodCode"]) || empty($foodData["foodCode"])) {
			$result['foodCode'] = true;
			$validate = false;
		}
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
		$x = $width * ($foodData["cropX"] / $foodData["imageW"]);
		$y = $height * ($foodData["cropY"] / $foodData["imageH"]);
		$d = $width * ($foodData["cropW"] / $foodData["imageW"]);
		$sizer->resize($x, $y, $s, $d);
		$sizer->save(self::$thumDir . $foodData["image"]);
		
		$food = new Food();
		$food->setCode($foodData["foodCode"]);
		$food->setName($foodData["foodName"]);
		$food->setPrice($foodData["foodPrice"]);
		$food->setFoodTypeId(1);
		$food->setStatus(true);
		$food->setThumbnail($foodData["image"]);
		$food->setImage($foodData["image"]);
		$food->insertDatabase(null);
		
		echo json_encode($result);
	}
}