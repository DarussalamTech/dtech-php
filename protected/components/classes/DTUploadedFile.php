<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItstUploadFile
 *
 * @author Brain
 */
class DTUploadedFile extends CUploadedFile {
    //put your code here

    /**
     *  to create recursive folder
     *  here images will be uploaded
     */
    public static function creeatRecurSiveDirectories($array = array()) {
        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }
        if (is_array($array)) {
            $newPath = $basePath;
            $array = array_merge(array("uploads"), $array);

            foreach ($array as $folder) {
                $newPath.=DIRECTORY_SEPARATOR . $folder;
                if (!is_dir($newPath)) {
                    mkdir($newPath, 0755);
                }
            }
        } else {
            return "error";
        }
        return $newPath . DIRECTORY_SEPARATOR;
    }

    /**
     * to delete to folder recursivly data
     * @param type $folder 
     *   folder path 
     * @param type $is_actual_path 
     *       means folder full path is set to false
     *       folder is fullpath
     *       other wise on temp folder
     */
    public static function deleteRecursively($folder, $is_actual_path = false) {
        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }
        $deleted_dir = $basePath . DIRECTORY_SEPARATOR . "temp" . DIRECTORY_SEPARATOR . $folder;

        $deleted_dir = ($is_actual_path == true) ? $folder : $deleted_dir;

        if (is_dir($deleted_dir) && $handle = opendir($deleted_dir)) {


            /* This is the correct way to loop over the directory. */
            while (($file = readdir($handle)) !== false) {

                if ($file != "." || $file != "..") {

                    /**
                     * In case of direcotries 
                     * These line will done
                     * 
                     */
                    if (filetype($deleted_dir . DIRECTORY_SEPARATOR . $file) == "dir") {
                        $dirData = scandir($deleted_dir . DIRECTORY_SEPARATOR . $file);

                        if (!empty($dirData)) {

                            self::deleteRecursively($folder . DIRECTORY_SEPARATOR . $file);
                            if (count($dirData) == 2 && in_array(".", $dirData) && in_array("..", $dirData)) {
                                rmdir($deleted_dir . DIRECTORY_SEPARATOR . $file);
                                self::deleteRecursively($deleted_dir . DIRECTORY_SEPARATOR . $file);
                            }
                        }
                    } else {
                        unlink($deleted_dir . DIRECTORY_SEPARATOR . $file);
                    }
                }
            }


            closedir($handle);
        }
    }

    /**
     * 
     * @param type $file 
     * to detled file on particulr locaton
     */
    public static function deleteExistingFile($file) {
        if (is_file($file)) {
            unlink($file);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $pathToImages
     * @param type $pathToThumbs
     * @param type $thumbWidth
     */
    public static function createThumbs($pathToImage, $pathToThumbs, $thumbWidth, $name) {
        // open the directory
        // parse path for the extension
        $info = pathinfo($pathToImage);
 



        // continue only if this is a JPEG image
        //echo "Creating thumbnail for {$pathToImage} <br />";
        // load image and get image size


        $img = self::imageCreateFrom("$pathToImage", $info['extension']);
        $width = imagesx($img);
        $height = imagesy($img);
        // calculate thumbnail size
        $new_width = $thumbWidth;
        $new_height = floor($height * ( $thumbWidth / $width ));
        // create a new temporary image
        $tmp_img = imagecreatetruecolor($new_width, $new_height);
        // copy and resize old image into new image
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        // save thumbnail into a file
        self::createImage($tmp_img, $pathToThumbs, $name, trim($info['extension']));
    }

    /**
     * on the bases of value extension
     */
    public static function imageCreateFrom($pathToImage, $ext) {

        switch ($ext) {
            case 'png':
                return imagecreatefrompng($pathToImage);
                break;
            case 'jpeg':
                return imagecreatefromjpeg($pathToImage);
                break;
            case 'jpg':
                return imagecreatefromjpeg($pathToImage);
                break;
            case 'JPG':
                return imagecreatefromjpeg($pathToImage);
                break;
            case 'gif':
                return imagecreatefromgif($pathToImage);
                break;
            case 'wbmp':
                return imagecreatefromwbmp($pathToImage);
                break;

            default :
                return FALSE;
        }
    }

    /**
     * acutal the bases of value extension
     */
    public static function createImage($tmp_img, $pathToThumbs, $name, $ext) {

        switch ($ext) {
            case 'png':
                imagegif($tmp_img, "$pathToThumbs" . DIRECTORY_SEPARATOR . $name);
                break;
            case 'jpeg':
                imagejpeg($tmp_img, "$pathToThumbs" . DIRECTORY_SEPARATOR . $name);
                break;
            case 'jpg':
                imagejpeg($tmp_img, "$pathToThumbs" . DIRECTORY_SEPARATOR . $name);
                break;
            case 'gif':
                imagegif($tmp_img, "$pathToThumbs" . DIRECTORY_SEPARATOR . $name);
                break;
            case 'wbmp':
                imagewbmp($tmp_img, "$pathToThumbs" . DIRECTORY_SEPARATOR . $name);
                break;

            default :
                return FALSE;
        }
    }

}

?>
