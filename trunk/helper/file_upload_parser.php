<?php
require_once ('ImageSizer.php');
if (! isset ( $_FILES ["file"] )) {
	echo "Please browse for a file before clicking the upload button.";
	exit ();
}
$df = "Ymd-H-i-s";
$fileName = "TMPIMG" . date($df) . ".jpg";
$fileTmpLoc = $_FILES ["file"] ["tmp_name"];
$fileType = $_FILES ["file"] ["type"];
$fileSize = $_FILES ["file"] ["size"];
$fileErrorMsg = $_FILES ["file"] ["error"]; // 0 for false... and 1 for true
if (! $fileTmpLoc) { // if file not chosen
	echo "Please browse for a file before clicking the upload button.";
	exit ();
}
$tmpPath = "assets/upload/tmp/";
if (move_uploaded_file ( $fileTmpLoc, $_SERVER ['DOCUMENT_ROOT'] . $tmpPath . $fileName )) {
	$imageSizer = new ImageSizer();
	$imageSizer->load($_SERVER ['DOCUMENT_ROOT'] . $tmpPath . $fileName);
	$imageSizer->resizeToWidth(500);
	$imageSizer->crop();
	$imageSizer->save($_SERVER ['DOCUMENT_ROOT'] . $tmpPath . $fileName);
	
	echo '{"message":"File upload completed",
			"image":"' . $tmpPath . $fileName. '",
			"alt":"Food image"}';
} else {
	echo "failed moving file upload";
}
?>