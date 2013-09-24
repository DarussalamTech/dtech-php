<?php

class m130830_063950_altercolumnPrefix extends DTDbMigration {

    public function up() {
        $table = "user_order_billing";

        $this->alterColumn($table, "billing_prefix", "varchar(4) DEFAULT NULL");

        $table = "user_order_shipping";

        $this->alterColumn($table, "shipping_prefix", "varchar(4) DEFAULT NULL");
    }

    public function down() {
        $table = "user_order_billing";

        $this->alterColumn($table, "billing_prefix", "varchar(3) DEFAULT NULL");

        $table = "user_order_shipping";

        $this->alterColumn($table, "shipping_prefix", "varchar(3) DEFAULT NULL");
    }

}