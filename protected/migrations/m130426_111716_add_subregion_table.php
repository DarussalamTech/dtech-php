<?php

class m130426_111716_add_subregion_table extends CDbMigration {

    public function up() {
        $table = 'subregion';
        $columns = array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'region_id' => 'int(10) unsigned default NULL',
            'name' => 'varchar(45) default NULL',
            'timezone' => 'varchar(45) default NULL',
            'PRIMARY KEY  (`id`)',
            'KEY `subregion_region_id` (`region_id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = 'subregion';
        $this->dropTable($table);
    }

}