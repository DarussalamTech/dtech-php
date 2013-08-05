<?php

class m130805_061030_insertProductCategories extends DTDbMigration {

    public function up() {
        $table = "dt_messages";
        $records = $this->getQueryAll("SELECT DISTINCT(category_name) FROM categories");
        
        foreach ($records as $key => $tr) {
            $columns = array(
                "category" => "product_category",
                "message" => $tr['category_name'],
            );
            $this->insertRow($table, $columns);
        }
    }

    public function down() {
        return true;
    }

}