<?php

class m131217_122329_addUnitWeightColumnInMigration extends DTDbMigration {

    public function up() {
        $table = "product_profile";
        $this->addColumn($table, "weight_unit", "enum('g','kg') DEFAULT NULL after weight");
    }

    public function down() {
        $table = "product_profile";
        $this->dropColumn($table, "weight_unit");
    }

}