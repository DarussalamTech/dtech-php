<?php

class m130625_061627_addNewtableconf_books extends DTDbMigration {

    public function up() {
        $table = "conf_products";
        $columns = array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'title' => 'varchar(255) NOT NULL',
            'type' => 'enum("Dimensions","Binding","Printing","Paper") NOT NULL',
            'parent' => 'enum("Books","Others","Quran","Educational Toys") NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "conf_products";
        $this->dropTable($table);
    }

}