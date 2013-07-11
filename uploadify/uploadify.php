<?php

$targetFolder = 'temp'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);
$file = 'license.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= "John Smith\n";
// Write the contents back to the file


if(isset($_POST['user_Id'])){
    mkdir($_POST['bastPath']."/../uploadify/temp/".$_POST['user_Id']);
    $targetFolder = $_POST['bastPath']."/../uploadify/temp/".$_POST['user_Id'];
    
}

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath =  $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
        
        file_put_contents($file, print_r($_FILES['Filedata'],true));
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>