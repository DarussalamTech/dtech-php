<?php

class m130522_075550_add_fieldIndorder extends DTDbMigration {

    public function up() {
        $table = "order";
        $this->addColumn($table, "status", "enum('process','approved','completed','declined') DEFAULT 'process' after order_date");
        $this->addColumn($table, "transaction_id", "varchar(255) DEFAULT NULL after status");
        $this->addColumn($table, "payment_method_id", "int(10) unsigned NOT NULL");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "status");
        $this->dropColumn($table, "transaction_id");
        $this->dropColumn($table, "payment_method_id");
    }

}