<?php
class Uploader {
	
	public static function getTempFile () {
		return $_FILES ["file"] ["tmp_name"];
	}
	
	public static function getType () {
		return $_FILES ["file"] ["type"];
	}
	
	public static function getExtension () {
		return pathinfo($_FILES["file"] ["name"])["extension"];
	}
	
	public static function getSize () {
		return $_FILES ["file"] ["size"];
	}
	
	public static function getError () {
		return $_FILES ["file"] ["error"];
	}
	
	public static function moveUploadFileTo ($toDir, $file) {
		if (empty($toDir) || empty($file)) {
			return false;
		}
		if (!file_exists($toDir)) {
			mkdir($toDir, 0777, true);
		}
		if (move_uploaded_file(Uploader::getTempFile(), $toDir . $file)) {
			return true;
		}
		return false;
	}
	
	public static function moveTo ($from, $toDir, $file) {
		if (file_exists($from) && is_file($from)) {
			if (empty($toDir) || empty($file)) {
				return false;
			}
			if (!file_exists($toDir)) {
				mkdir($toDir, 0777, true);
			}
			rename($from, $toDir . $file);
			return true;
		} else {
			return false;
		}
	}
}

/*require_once ('ImageSizer.php');
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
}*/
?>