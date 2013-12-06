<?php

class m131206_065411_addShippingClassColumns extends DTDbMigration {

    public function up() {
        $table = "shipping_class";
        $this->addColumn($table, "is_weight_based", "TINYINT(1) DEFAULT 0 after end_price");
        $this->renameColumn($table, "shipping_price", "fix_shipping_cost");
        $this->addColumn($table, "price_range_shipping_cost", "double(12,3) DEFAULT NULL after is_pirce_range");
        $this->addColumn($table, "weight_range_shipping_cost", "double(12,3) DEFAULT NULL after is_weight_based");
    }

    public function down() {
        $table = "shipping_class";
        $this->dropColumn($table, "is_weight_based");
        $this->renameColumn($table, "fix_shipping_cost", "shipping_price");
        
        $this->dropColumn($table, "price_range_shipping_cost");
        $this->dropColumn($table, "weight_range_shipping_cost");
    }

}