<?php

class m130826_095447_addOrderAuditTable extends DTDbMigration {

    public function up() {
        $table = "order_history";
        $columns = array(
            'id' => 'int(11)  NOT NULL auto_increment',
            'comment' => 'text DEFAULT NULL',
            'user_id' => 'int(11) NOT NULL',
            'order_id' => 'int(11) NOT NULL',
            'status' =>"enum('pending','process', 'completed', 'declined') NOT NULL",
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
        
        $this->addForeignKey("fk_".$table, $table, 'order_id', 'order', 'order_id');
        
    }

    public function down() {
       
       $table = "order_history";
       $this->dropForeignKey("fk_".$table, $table);
       $this->dropTable($table);

    }

}