<?php
	error_reporting(0);

// Define a destination
$targetFolder = $_POST['targetFolder']; // Relative to the root           http://t3china.t3group.cn/

$verifyToken = md5('unique_salt' . $_POST['timestamp']);
//echo $verifyToken; && $_POST['token'] == $verifyToken
if (!empty($_FILES)) {

	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'].'/'. $targetFolder. '/';
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	

	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $targetFile;
	} else {
		echo 'Invalid file type.';
	}
}
?>