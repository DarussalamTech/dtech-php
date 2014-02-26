<?php

class m140225_105518_addRelatedProducts extends DTDbMigration {

    public function up() {
        $table = "related_product";
        $columns = array(
            'id' => 'int(11)  NOT NULL auto_increment',
            'product_id' => 'int(11) NOT NULL',
            'related_product_id' => 'int(11) NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
         $table = "related_product";
         $this->dropTable($table);
    }

}