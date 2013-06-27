<?php

class m130509_093134_add_translator_compiler_table extends CDbMigration {

    public function up() {
        $table = 'translator_compiler';
        $columns = array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'name' => 'varchar(255) NOT NULL',
            'type' => 'enum("translator","compiler") NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'activity_log' => 'text',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = 'translator_compiler';
        $this->dropTable($table);
    }

}