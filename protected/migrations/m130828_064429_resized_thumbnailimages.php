<?php

class m130828_064429_resized_thumbnailimages extends DTDbMigration {

    public function up() {

        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $basePath = $basePath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "product" . DIRECTORY_SEPARATOR;


        /**
         * table operation
         */
        $sql = "SELECT *
             FROM product_image";

        $all_data = $this->getQueryAll($sql);
        foreach ($all_data as $data) {

            $product_dir = $basePath . $data['product_profile_id'];
            $image_dir = $product_dir . DIRECTORY_SEPARATOR . 'product_images' . DIRECTORY_SEPARATOR . $data['id'];
            $largeImg = $image_dir . DIRECTORY_SEPARATOR . $data['image_large'];

            if (is_dir($product_dir) && is_dir($image_dir) && is_file($largeImg)) {

                if ($data['image_small'] == NULL) {
                    $img_name_small = trim(trim("small_" . $data['image_large']));
                } else {
                    $img_name_small = $data['image_small'];
                }

                echo $largeImg . "\n";
                DTUploadedFile::createThumbs($largeImg, $image_dir, 130, $img_name_small);
            }

            // DTUploadedFile::createThumbs($dest_image, $image_dir, 150, $small_img);
        }
     
    }

    public function down() {
        echo "m130524_115156_upload_images does not support migration down.\n";
        return true;
    }

}