<?php

class m140428_055047_addUniversalNameFieldInProduct extends DTDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "universal_name", "varchar(255) DEFAULT NULL after product_name");
    }

    public function down() {
        $table = "product";
        $this->dropColumn($table, "universal_name");
    }

}