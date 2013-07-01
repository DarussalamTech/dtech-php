<?php

class m130701_115524_create_table_product_att_conf extends CDbMigration {

    public function up() {
        $table = "product_attributes_conf";
        $columns = array(
            'id' => 'int(11)  NOT NULL auto_increment',
            'title' => 'varchar(255) NOT NULL',
            'product_type' => 'enum("Books","Others","Quran","Educational Toys") NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "product_attributes_conf";
        $this->dropTable($table);
    }

}