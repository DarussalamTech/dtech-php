<?php

class m130524_113255_insert_product_profile extends DTDbMigration {

    public function up() {
        
        $table = "product_profile";
        
        $this->delete($table);

        $products = $this->findAllRecords("product", array("product_id", "product_name"), "product_id", "product_name");

        $basePath = Yii::app()->basePath;

        if (strstr($basePath, "protected")) {
            $basePath = realPath($basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);
        }

        $counter = 1;
        foreach ($products as $id => $name) {

            $dt = new DTFunctions();
            $price = $dt->getIntRanddomeNo(2);
            $columns = array(
                "id" => $counter,
                "item_code" => "book_code_" . $counter,
                "language_id" => 2,
                "product_id" => $id,
                "price" => (int) $price,
                "isbn" => "444-558-754-" . $counter,
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
                "activity_log" => "inserted by Admin",
            );

            $this->insert($table, $columns);

            $counter++;
        }
    }

    public function down() {
        $table = "product_profile";
    }

}