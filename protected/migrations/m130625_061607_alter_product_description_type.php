<?php

class m130625_061607_alter_product_description_type extends CDbMigration {

    public function up() {
        $table = "product";
        $this->alterColumn($table, "product_description", "LONGTEXT NOT NULL");
    }

    public function down() {
        $table = "product";
        $this->alterColumn($table, "product_description", "TEXT NOT NULL");
    }

}