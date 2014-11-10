<?php
require_once ('ImageSizer.php');
if (! isset ( $_FILES ["file"] )) {
	echo "Please browse for a file before clicking the upload button.";
	exit ();
}
$df = "Ymd-H-i-s";
$tmpPath = "assets/upload/tmp/";
$fileName = "TMPIMG" . date($df) . "." . pathinfo($_FILES["file"] ["name"])["extension"];
$fileTmpLoc = $_FILES ["file"] ["tmp_name"];
$fileType = $_FILES ["file"] ["type"];
$fileSize = $_FILES ["file"] ["size"];
$fileErrorMsg = $_FILES ["file"] ["error"]; // 0 for false... and 1 for true
$fileAllow = array("image/jpeg", "image/png", "image/gif");
if (! $fileTmpLoc) { // if file not chosen
	echo "Please browse for a file before clicking the upload button.";
	exit ();
}
if (!in_array($fileType, $fileAllow)) {
	echo "Please choose only image file (jpg, png or gif).";
	exit ();
}
if (move_uploaded_file ( $fileTmpLoc, $_SERVER ['DOCUMENT_ROOT'] . $tmpPath . $fileName )) {
	echo '{"message":"File upload completed",
			"image":"' . $tmpPath . $fileName. '",
			"alt":"' . $fileName . '"}';
} else {
	echo "failed moving file upload";
}
?>