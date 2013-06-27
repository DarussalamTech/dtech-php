<?php

class m130430_103046_add_pages_table extends CDbMigration {

    public function up() {

        $table = 'pages';
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'city_id' => 'int(11)',
            'title' => 'varchar(255) NOT NULL',
            'content' => 'LONGTEXT NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'activity_log' => 'text DEFAULT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {

        $table = 'pages';
        $this->dropTable($table);
    }

}