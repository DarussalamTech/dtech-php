<?php

class m130430_050524_add_region_subregion_new_tables extends CDbMigration {

    public function up() {

        $table = 'region';
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(128) NOT NULL',
            'iso_code_2' => 'varchar(2) NOT NULL',
            'iso_code_3' => 'varchar(3) NOT NULL',
            'address_format' => 'text NOT NULL',
            'postcode_required' => 'tinyint(1) NOT NULL',
            'status' => 'tinyint(1) NOT NULL DEFAULT "1"',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);

        $table = 'subregion';
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'region_id' => 'int(11) NOT NULL',
            'name' => 'varchar(128) NOT NULL',
            'code' => 'varchar(32) NOT NULL',
            'status' => 'tinyint(1) NOT NULL DEFAULT "1"',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = 'subregion';
        $this->dropTable($table);
        $table = 'region';
        $this->dropTable($table);
    }
}