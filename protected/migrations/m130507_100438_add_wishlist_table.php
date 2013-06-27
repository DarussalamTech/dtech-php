<?php

class m130507_100438_add_wishlist_table extends CDbMigration {

    public function up() {
        $table = 'wish_list';
        $columns = array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'product_id' => 'int(11) NOT NULL',
            'user_id' => 'int(11) NOT NULL',
            'city_id' => 'int(11) NOT NULL',
            'added_date' => 'datetime NOT NULL',
            'session_id' => 'varchar(255) default NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'activity_log' => 'text',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = 'wish_list';
        $this->dropTable($table);
    }

}