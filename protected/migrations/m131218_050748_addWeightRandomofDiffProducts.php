<?php

class m131218_050748_addWeightRandomofDiffProducts extends DTDbMigration {

    public function up() {


        $all_data = $this->findAllRecords("product_profile", array("id", "weight"), "id", "weight", "WHERE weight IS  NULL");

        foreach ($all_data as $id => $weight) {
            $dt = new DTFunctions();
            $columns = array(
                "weight" => $dt->getIntRanddomeNo(2)
            );

            $this->update("product_profile", $columns, 'id = ' . $id);
        }

        $all_data = $this->findAllRecords("product_profile", array("id", "weight"), "id", "weight");
        foreach ($all_data as $id => $weight) {
            $dt = new DTFunctions();
            $columns = array(
                "weight_unit" => ($weight <= 5) ? "kg" : "g"
            );

            $this->update("product_profile", $columns, 'id = ' . $id);
        }
    }

    public function down() {
        return true;
    }

}