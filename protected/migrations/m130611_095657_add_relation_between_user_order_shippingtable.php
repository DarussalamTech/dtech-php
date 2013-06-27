<?php

class m130611_095657_add_relation_between_user_order_shippingtable extends CDbMigration {

    public function up() {
        $table = "user_order_shipping";
        $this->addForeignKey('fk_user_orderShipping', $table, 'user_id', 'user', 'user_id', "CASCADE", "CASCADE");
        $this->addForeignKey('fk_order_orderShipping', $table, 'order_id', 'order', 'order_id', "CASCADE", "CASCADE");
    }

    public function down() {
        $table = "user_order_shipping";
        $this->dropForeignKey('fk_user_orderShipping', $table);
        $this->dropForeignKey('fk_order_orderShipping', $table);
    }

}