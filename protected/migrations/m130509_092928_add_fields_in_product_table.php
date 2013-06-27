<?php

class m130509_092928_add_fields_in_product_table extends CDbMigration {

    public function up() {
        $table = "product";
        $this->dropColumn($table, "product_price");
        $this->dropColumn($table, "discount_type");
        $this->dropColumn($table, "discount_value");
        $this->dropColumn($table, "languages");
        $this->dropColumn($table, "isbn");
    }

    public function down() {
        $table = "product";
        $this->addColumn($table, "isbn", "varchar(255) DEFAULT NULL");
        $this->addColumn($table, "product_price", "int(11) DEFAULT NULL");
        $this->addColumn($table, "discount_type", "enum('fixed','percentage') DEFAULT NULL");
        $this->addColumn($table, "discount_value", "int(11) DEFAULT NULL");
        $this->addColumn($table, "languages", "varchar(255) DEFAULT NULL");
    }

}