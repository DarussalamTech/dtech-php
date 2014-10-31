<?php

class m141030_092853_createShippingTypeInUserOrderShipping extends DTDbMigration
{
    public function up() {
        $table = "user_order_shipping";
        $this->addColumn($table, "shipping_type", "varchar(255) DEFAULT NULL after payment_method");
    }

    public function down() {
        $table = "user_order_shipping";
        $this->dropColumn($table, "shipping_type");
    }
}