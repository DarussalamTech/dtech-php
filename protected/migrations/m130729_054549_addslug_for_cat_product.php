<?php

class m130729_054549_addslug_for_cat_product extends DTDbMigration {

    public function up() {
        $table = "product";
        $columns = array("product_id", "product_name");
        $data = $this->findAllRecords($table, $columns, "product_id", "product_name");
        foreach ($data as $id =>$product_name) {
            $slug = str_replace(" ", "-", $product_name);
            $this->update($table, array("slag" => $slug), "product_id = " . $id);
        }

        //

        $table = "product_profile";
        $columns = array("id", "title");
        $data = $this->findAllRecords($table, $columns, "id", "title");
        foreach ($data as $id =>$product_name) {
            $slug = str_replace(" ", "-", $product_name);
            $this->update($table, array("slag" => $slug), "id = " . $id);
        }
        //
    }

    public function down() {
        return true;
    }

}