<?php

class m130524_111312_add_product_inTable extends DTDbMigration {

    public function up() {
        $table = "product_profile";
        
        $this->delete($table);
        
        $table = "product";
        $this->delete($table);
        $categores = $this->findAllRecords("categories", array("category_id", "category_name"), "category_id", "category_name");


        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }



        $books_path = $basePath . DIRECTORY_SEPARATOR . "bookFromksa" . DIRECTORY_SEPARATOR;
        $book_id = 1;
        foreach ($categores as $cat_id => $cat_name) {

            $newPath = $books_path . DIRECTORY_SEPARATOR . $cat_name;
            if (is_dir($newPath) && $handle = opendir($newPath)) {

                $counter = 1;
                /* This is the correct way to loop over the directory. */
                while (($file = readdir($handle)) !== false) {

                    if ($file != "." && $file != "..") {

                        /**
                         * In case of direcotries 
                         * These line will done
                         * 
                         */
                        $file = str_replace(".jpg", "", $file);
                        $file = str_replace(".jpeg", "", $file);
                        $file = str_replace(".gif", "", $file);
                        
                        $file = str_replace(".JPG", "", $file);
                        $file = str_replace(".JPEG", "", $file);
                        $file = str_replace(".GIF", "", $file);
                        
                        $prod_name = $cat_name . "_" . $counter . "_" . $file . PHP_EOL;

                        $columns = array(
                            "product_id" => $book_id,
                            "product_name" => $prod_name,
                            "product_description" => $prod_name,
                            "city_id" => 1,
                            "create_time" => date("Y-m-d H:i:s"),
                            "create_user_id" => 1,
                            "update_time" => date("Y-m-d H:i:s"),
                            "update_user_id" => 1,
                            "activity_log" => "inserted by Admin",
                        );
                        $this->insert($table, $columns);
                        
                        $columns = array(
                            "product_id" => $book_id,
                            "category_id" => $cat_id,
                            "create_time" => date("Y-m-d H:i:s"),
                            "create_user_id" => 1,
                            "update_time" => date("Y-m-d H:i:s"),
                            "update_user_id" => 1,
                            "activity_log" => "inserted by Admin",
                        );
                        $this->insert("product_categories", $columns);

                        $counter++;
                        
                        
                        $book_id++;
                    }
                }


                closedir($handle);
            }
        }
        //die;
    }

    public function down() {
        
    }

}