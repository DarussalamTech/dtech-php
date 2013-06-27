<?php

class m130524_103930_addProducts extends DTDbMigration {

    public function up() {
        
        $table = "product_image";
        $this->truncateTable($table);
        
        $table = "cart";
        $this->truncateTable($table);
       
        $table = "order_detail";
        $this->truncateTable($table);
        
        $table = "order";
        $this->delete($table);
        //$this->truncateTable($table);
        
        $table = "product_profile";
        $this->delete($table);
        //$this->truncateTable($table);
        
        $table = "product";
        $this->delete($table);
        //$this->truncateTable($table);
        
        $table = "product_categories";
        $this->delete($table);
        //$this->truncateTable($table);
        
        $table = "categories";
        $this->delete($table);
        //$this->truncateTable($table);
        
        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $books_path = $basePath . DIRECTORY_SEPARATOR . "bookFromksa" . DIRECTORY_SEPARATOR;

        if (is_dir($books_path) && $handle = opendir($books_path)) {


            /* This is the correct way to loop over the directory. */
            while (($file = readdir($handle)) !== false) {

                if ($file != "." && $file != "..") {

                    /**
                     * In case of direcotries 
                     * These line will done
                     * 
                     */
                    echo $file . PHP_EOL;
                    $columns = array(
                        "category_name" => $file,
                        "added_date" => strtotime(Date("Y-m-d")),
                        "city_id" => 1,
                        "create_time" => date("Y-m-d H:i:s"),
                        "create_user_id" => 1,
                        "update_time" => date("Y-m-d H:i:s"),
                        "update_user_id" => 1,
                        "activity_log" => "inserted by Admin",
                    );
                    $this->insert($table, $columns);
                }
            }


            closedir($handle);
        }
    }

    public function down() {
        return true;
    }

}