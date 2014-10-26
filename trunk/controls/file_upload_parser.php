<?php
if (! isset ( $_FILES ["file"] )) {
	echo "Please browse for a file before clicking the upload button.";
	exit ();
}
$fileName = $_FILES ["file"] ["name"];
$fileTmpLoc = $_FILES ["file"] ["tmp_name"];
$fileType = $_FILES ["file"] ["type"];
$fileSize = $_FILES ["file"] ["size"];
$fileErrorMsg = $_FILES ["file"] ["error"]; // 0 for false... and 1 for true
if (! $fileTmpLoc) { // if file not chosen
	echo "Please browse for a file before clicking the upload button.";
	exit ();
}
$fileName = $_SERVER ['DOCUMENT_ROOT'] . "/assets/upload/tmp/" . $fileName;
if (move_uploaded_file ( $fileTmpLoc, "$fileName" )) {
	echo "File upload is completed";
} else {
	echo "move_uploaded_file failed";
}
?>