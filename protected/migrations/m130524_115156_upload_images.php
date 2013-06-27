<?php

class m130524_115156_upload_images extends DTDbMigration {

    public function up() {

        $condition = "";
        $categores = $this->findAllRecords("categories", array("category_id", "category_name"), "category_id", "category_name", $condition);


        $cat_counter = 1;
        foreach ($categores as $cat_id => $cat_name) {
            $this->uploadImages($cat_id, $cat_counter);
        }
    }

    public function down() {
        echo "m130524_115156_upload_images does not support migration down.\n";
        return true;
    }

    public function uploadImages($cat_id, $cat_counter) {

        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $books_path = $basePath . DIRECTORY_SEPARATOR . "bookFromksa" . DIRECTORY_SEPARATOR;
        /**
         * table operation
         */
        $table = "product_image";
        $sql = "SELECT DISTINCT(product_profile.id),
                product_profile.item_code,
                categories.category_name, product.product_name
                FROM categories
                INNER JOIN product_categories ON categories.category_id = product_categories.category_id
                INNER JOIN product ON product_categories.product_id = product.product_id
                INNER JOIN product_profile ON product.product_id = product_profile.product_id 
                WHERE categories.category_id = " . $cat_id . "

                Order by product_profile.id
                ";

        $all_data = $this->getQueryAll($sql);


        $counter = 1;
        foreach ($all_data as $key => $data) {

            $img_name = str_replace($data['category_name'] . "_" . $cat_counter . "_", "", $data['product_name']);
            $img_name = trim($img_name);
            $book_image = $books_path . $data['category_name'] . DIRECTORY_SEPARATOR . $img_name . ".jpg";

            $book_image_caps = $books_path . $data['category_name'] . DIRECTORY_SEPARATOR . $img_name . ".JPG";
            //echo $book_image . PHP_EOL;
            
            $small_img = trim(trim("small_" . $data['product_name']) . ".jpg");
            $large_img = trim(trim($data['product_name']) . ".jpg");
            
            
            $columns = array(
                "id" => $data['id'],
                "product_profile_id" => $data['id'],
                "image_small" => $small_img,
                "image_large" => $large_img,
                "is_default" => 1,
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
                "activity_log" => "inserted by Admin",
            );

            $image_dir = DTUploadedFile::creeatRecurSiveDirectories(array("product", $data['id'], "product_images", $data['id'],));
            $dest_image = $image_dir . $large_img;

            //$book_image = (string)trim($book_image);
            //$dest_image = (string)trim($dest_image);
            $this->insert($table, $columns);

            if (is_file($book_image)) {
                copy("$book_image", "$dest_image");
                DTUploadedFile::createThumbs($dest_image, $image_dir, 150, $small_img);
            } else if (is_file($book_image_caps)) {
                copy("$book_image_caps", "$dest_image");
                DTUploadedFile::createThumbs($dest_image, $image_dir, 150, $small_img);
            }


            $counter++;
            $cat_counter++;
        }
    }

}