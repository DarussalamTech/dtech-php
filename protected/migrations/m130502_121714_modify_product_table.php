<?php

class m130502_121714_modify_product_table extends CDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "authors", "varchar(255) DEFAULT NULL after product_rating");
        $this->addColumn($table, "isbn", "varchar(255) DEFAULT NULL after authors");
        $this->addColumn($table, "discount_type", "enum('fixed','percentage') after isbn");
        $this->addColumn($table, "discount_value", "int(11) DEFAULT NULL after discount_type");
        $this->addColumn($table, "languages", "varchar(255) DEFAULT NULL after discount_value");
    }

    public function down() {
        $table = "product";
        $this->dropColumn($table, "authors");
        $this->dropColumn($table, "isbn");
        $this->dropColumn($table, "discount_type");
        $this->dropColumn($table, "discount_value");
        $this->dropColumn($table, "languages");
    }

}