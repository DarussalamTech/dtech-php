<?php

class m130610_083400_removecolumns extends DTDbMigration {

    public function up() {
        $table = "product_profile";
        $this->dropColumn($table, "discount_type");
        $this->dropColumn($table, "discount_value");
    }

    public function down() {
         $table = "product_profile";
         
         $this->addColumn($table, "discount_value", "int(11) DEFAULT NULL after price");
         $this->addColumn($table, "discount_type", "enum('fixed','percentage') DEFAULT NULL after discount_value");
    }

}