<?php
require_once 'ImageSizer.php';
$foodData = json_decode($_POST["foodData"], true);

$result = array();
$status = true;
$validate = true;
$error = " has-error";

$result["foodCode"] = "form-group";
$result["foodName"] = "form-group";
$result["foodPrice"] = "form-group";
$result["foodType"] = "form-group";

if (empty($foodData["foodCode"])) {
	$result["foodCode"] .= $error;
	$validate = false;
}
if (empty($foodData["foodName"])) {
	$result["foodName"] .= $error;
	$validate = false;
}
if (empty($foodData["foodPrice"])) {
	$result["foodPrice"] .= $error;
	$validate = false;
}
if (empty($foodData["foodType"])) {
	$result["foodType"] .= $error;
	$validate = false;
}
$result["validate"] = $validate;
			
if ($validate === false) {
	echo json_encode($result);
	exit();
} else {
	if (!empty($foodData["image"])) {
		if(!empty($foodData["cropW"]) || !empty($foodData["cropH"])) {
			$tmpPath = "assets/upload/tmp/";
			$thumPath = "assets/upload/thumbnail/";
			
			$sizer = new ImageSizer();
			$sizer->load($_SERVER ['DOCUMENT_ROOT'] . $tmpPath . $foodData["image"]);
			$width = $sizer->getWidth();
			$height = $sizer->getHeight();
			$x = $width * ($foodData["cropX"] / $foodData["imageW"]);
			$y = $height * ($foodData["cropY"] / $foodData["imageH"]);
			if ($width < $height) {
				$s = $width * ($foodData["cropW"] / $foodData["imageW"]);
			} else {
				$s = $height * ($foodData["cropH"] / $foodData["imageH"]);
			}
			$sizer->crop($x, $y, $s, $s);
			$sizer->save($_SERVER ['DOCUMENT_ROOT'] . $thumPath . $foodData["image"]);
		}
	}
	
	echo json_encode($result);
}
?>