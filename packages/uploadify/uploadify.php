<?php

/*
  Uploadify
  Copyright (c) 2012 Reactive Apps, Ronnie Garcia
  Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */

// Define a destination
$targetFolder = $_POST['uploaded_path']; // Relative to the root
$verifyToken = md5('unique_hash' . $_POST['timestamp']);

/**
 * Log area 
 */
$myFile = "test.txt";
$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, print_r($_POST, true) . "\n" . $targetFolder);
$verifyToken = md5('unique_hash' . $_POST['timestamp']);


if (!empty($_FILES))
{
    $temp_child_dir = $_POST['temp_child_dir'];
    $current_user = $_POST['current_user'];

    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = $targetFolder . DIRECTORY_SEPARATOR;

    /**
     * script for two directories
     *  
     */
    if (!is_dir($targetPath . DIRECTORY_SEPARATOR . $temp_child_dir))
    {
        mkdir($targetPath . DIRECTORY_SEPARATOR . $temp_child_dir, 0755);

    }
    if (!is_dir($targetPath . DIRECTORY_SEPARATOR . $temp_child_dir . DIRECTORY_SEPARATOR . $current_user))
    {
        mkdir($targetPath . DIRECTORY_SEPARATOR . $temp_child_dir . DIRECTORY_SEPARATOR . $current_user, 0755);
        $targetPath=$targetPath . DIRECTORY_SEPARATOR . $temp_child_dir . DIRECTORY_SEPARATOR . $current_user;
    }
    else
    {
        $targetPath = $targetPath . DIRECTORY_SEPARATOR . $temp_child_dir . DIRECTORY_SEPARATOR . $current_user;
    }

    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    $targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];
    if (in_array($fileParts['extension'], $fileTypes))
    {

        move_uploaded_file($tempFile, $targetFile);
        echo '1';
    }
    else
    {
        echo 'Invalid file type.';
    }
}
?>