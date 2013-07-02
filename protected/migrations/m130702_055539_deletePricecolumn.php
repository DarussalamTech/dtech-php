<?php

class m130702_055539_deletePricecolumn extends CDbMigration {

    public function up() {
        $table = "product_attributes";
        $this->dropColumn($table, "price");
    }

    public function down() {
        $table = "product_attributes";
        $this->addColumn($table, "price","double(12,3) DEFAULT NULL after attribute_value");
    }

}