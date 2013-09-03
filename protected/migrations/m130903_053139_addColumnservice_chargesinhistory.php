<?php

class m130903_053139_addColumnservice_chargesinhistory extends DTDbMigration {

    public function up() {
        $table = "order_history";
        $this->addColumn($table, "service_charges", "int(4) DEFAULT 0 after is_notify_customer");
    }

    public function down() {
        $table = "order_history";
        $this->dropColumn($table, "service_charges");
    }

}