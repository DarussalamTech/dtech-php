<?php

class m130904_104159_thumbsAgain extends DTDbMigration {

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
                
                if ($data['image_detail'] == NULL) {
                    $img_name_detail = trim(trim("detail_" . $data['image_large']));
                } else {
                    $img_name_detail = $data['image_detail'];
                }
                
                if ($data['image_cart'] == NULL) {
                    $img_name_cart = trim(trim("cart_" . $data['image_large']));
                } else {
                    $img_name_cart = $data['image_cart'];
                }

                echo $largeImg . "\n";
                DTUploadedFile::createThumbs($largeImg, $image_dir, 130, $img_name_small);
                DTUploadedFile::createThumbs($largeImg, $image_dir, 180, $img_name_detail);
                DTUploadedFile::createThumbs($largeImg, $image_dir, 75, $img_name_cart);
                
                $columns = array(
                    "image_detail"=>$img_name_detail,
                    "image_cart"=>$img_name_cart,
               
                );
                $this->update("product_image", $columns, "id = ".$data['id']);
               
            }

            // DTUploadedFile::createThumbs($dest_image, $image_dir, 150, $small_img);
        }
    }

    public function down() {
        echo "m130524_115156_upload_images does not support migration down.\n";
        return true;
    }

}