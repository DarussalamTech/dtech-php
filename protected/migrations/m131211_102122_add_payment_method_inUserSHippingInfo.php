<?php

class m131211_102122_add_payment_method_inUserSHippingInfo extends DTDbMigration {

    public function up() {
        $table = "user_order_shipping";
        $this->addColumn($table, "payment_method", "varchar(255) DEFAULT NULL after shipping_mobile");
    }

    public function down() {
        $table = "user_order_shipping";
        $this->dropColumn($table, "payment_method");
    }

}