<?php

class m130611_111433_RemoveRelation extends DTDbMigration {

    public function up() {
        $table = "user_order_shipping";
        $this->dropForeignKey('fk_order_orderShipping', $table);
        $this->alterColumn($table, "order_id", "int(11) DEFAULT NULL");
    }

    public function down() {
        $table = "user_order_shipping";
        $this->addForeignKey('fk_order_orderShipping', $table, 'order_id', 'order', 'order_id', "CASCADE", "CASCADE");
        $this->alterColumn($table, "order_id", "int(11) NOT NULL");
    }

}