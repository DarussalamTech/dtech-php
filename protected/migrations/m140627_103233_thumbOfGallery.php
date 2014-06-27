<?php

class m140627_103233_thumbOfGallery extends DTDbMigration {

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

                if ($data['image_gallery'] == NULL) {
                    $img_name_gallery = trim(trim("gallery_" . $data['image_large']));
                } else {
                    $img_name_gallery = $data['image_gallery'];
                }

                echo $largeImg . "\n";
                DTUploadedFile::createThumbs($largeImg, $image_dir, 400, $img_name_gallery);

                $this->update("product_image", array("image_gallery" => $img_name_gallery), 'id =' . $data['id']);
            }
        }
    }

    public function down() {

        return true;
    }

}