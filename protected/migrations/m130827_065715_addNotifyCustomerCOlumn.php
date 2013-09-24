<?php

class m130827_065715_addNotifyCustomerCOlumn extends DTDbMigration {

    public function up() {
        $table = "order_history";
        $this->addColumn($table, "is_notify_customer", "tinyint(1) DEFAULT 0 after status");
    }

    public function down() {
         $table = "order_history";
         $this->dropColumn($table, "is_notify_customer");
    }

}