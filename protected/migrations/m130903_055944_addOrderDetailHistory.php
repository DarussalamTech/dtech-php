<?php

class m130903_055944_addOrderDetailHistory extends DTDbMigration {

    public function up() {
        $table = "order_history_detail";
        $columns = array(
            'id' => 'int(11)  NOT NULL auto_increment',
            'order_detail_id' => 'int(11) NOT NULL',
            'quantity' => 'int(11) DEFAULT 0',
            'reverted_to_stock' => 'tinyint(0) DEFAULT 0',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);

        $this->addForeignKey("fk_" . $table, $table, 'order_detail_id', 'order_detail', 'user_order_id');
    }

    public function down() {

        $table = "order_history_detail";
        $this->dropForeignKey("fk_" . $table, $table);
        $this->dropTable($table);
    }

}