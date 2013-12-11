<?php

class m131211_152354_addShippingPriceInOrder extends DTDbMigration {

    public function up() {
        $table = "order";
        $this->addColumn($table, "shipping_price", "decimal(10,4) DEFAULT 0 after total_price");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "shipping_price");
    }

}