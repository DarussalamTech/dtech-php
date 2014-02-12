<?php

class m131217_124152_updateUnitOfPRoductProfile extends DTDbMigration {

    public function up() {
        $all_records = $this->findAllRecords("conf_products", array("id", "title"), "id", "title", "WHERE type = 'weight'");
       
        $all_data = $this->findAllRecords("product_profile", array("id", "weight"), "id", "weight", "WHERE weight IS NOT NULL");
        foreach ($all_data as $id => $weight) {
            if (isset($all_records[$weight])) {
                $columns = array(
                    "weight" => $all_records[$weight]
                );


                $this->update("product_profile", $columns, 'id = ' . $id);
            }
        }
    }

    public function down() {
        return true;
    }

}