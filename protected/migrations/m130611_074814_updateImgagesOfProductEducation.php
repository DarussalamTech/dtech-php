<?php

class m130611_074814_updateImgagesOfProductEducation extends DTDbMigration {

    public function up() {

        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $books_path = $basePath . DIRECTORY_SEPARATOR . "video_devices" . DIRECTORY_SEPARATOR;

        $sql = "SELECT category_id FROM categories WHERE city_id = 1";
        $sql.= " AND category_name ='Educational Toys' ";

        $parent_category = $this->getQueryRow($sql);

        $parent_category['category_id'];


        $sql = "Select max(`product_image`.id) as id FROM `product_image`";

        $last_image = $this->getQueryRow($sql);
        $last_image_id = $last_image['id'] + 1;

        $sql = "SELECT 
                product_profile.id,
                product_profile.price,
                product.product_name
              FROM
                product
                INNER JOIN product_profile 
                    ON (product.product_id = product_profile.product_id)
              WHERE
                (city_id = 1) AND 
                (product.parent_cateogry_id = " . $parent_category['category_id'] . ")";

        $product_data = $this->getQueryAll($sql);
        $files_arr = $this->geFilesArray();

        $counter = 0;
        foreach ($product_data as $data) {
            if (isset($files_arr[$counter])) {
                $book_image = $books_path . $files_arr[$counter];
                $this->uploadImage($data, $last_image_id, $book_image);
                $last_image_id++;

                $counter++;
            }
        }

        
    }

    public function down() {
        
    }

    public function geFilesArray() {
        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $toysArray = array();


        $books_path = $basePath . DIRECTORY_SEPARATOR . "video_devices" . DIRECTORY_SEPARATOR;


        if (is_dir($books_path) && $handle = opendir($books_path)) {

            $counter = 0;
            /* This is the correct way to loop over the directory. */
            while (($file = readdir($handle)) !== false) {

                if ($file != "." && $file != "..") {
                    $toysArray[$counter] = $file;
                    $counter++;
                }
            }
        }

        return $toysArray;
    }

    public function uploadImage($data, $img_id, $book_image) {
        $data['product_name'] = str_replace(" ", "_", strtolower($data['product_name']));
        $small_img = trim(trim("small_" . $data['product_name']) . ".jpeg");
        $large_img = trim(trim($data['product_name']) . ".jpeg");


        $columns = array(
            "id" => $img_id,
            "product_profile_id" => $data['id'],
            "image_small" => $small_img,
            "image_large" => $large_img,
            "is_default" => 1,
            "create_time" => date("Y-m-d H:i:s"),
            "create_user_id" => 1,
            "update_time" => date("Y-m-d H:i:s"),
            "update_user_id" => 1,
        );

        $image_dir = DTUploadedFile::creeatRecurSiveDirectories(array("product", $data['id'], "product_images", $img_id,));
        $dest_image = $image_dir . $large_img;
        $this->insert("product_image", $columns);

        if (is_file($book_image)) {

            copy("$book_image", "$dest_image");
            DTUploadedFile::createThumbs($dest_image, $image_dir, 150, $small_img);
        }
    }

}