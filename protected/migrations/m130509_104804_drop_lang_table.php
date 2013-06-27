<?php

class m130509_104804_drop_lang_table extends CDbMigration {

    public function up() {
        $table = "product_language";
        $this->dropTable($table);
    }

    public function down() {
        $table = "product_language";
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

}