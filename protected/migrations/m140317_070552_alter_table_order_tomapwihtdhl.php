<?php

class m140317_070552_alter_table_order_tomapwihtdhl extends DTDbMigration {

    public function up() {
        $table = "order";
        $this->addColumn($table, "dhl_history_id", "int(11) DEFAULT NULL after transaction_id");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "dhl_history_id");
    }

}