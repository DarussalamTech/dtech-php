<?php

class m130426_104749_add_region_table extends CDbMigration {

    public function up() {
        $table='region';
        $columns=array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'iso' => 'varchar(45) default NULL',
            'iso3' => 'varchar(45) default NULL',
            'fips' => 'varchar(45) default NULL',
            'country' => 'varchar(45) default NULL',
            'continent' => 'varchar(45) default NULL',
            'currency_code' => 'varchar(45) default NULL',
            'currency_name' => 'varchar(45) default NULL',
            'phone_prefix' => 'varchar(45) default NULL',
            'postal_code' => 'varchar(45) default NULL',
            'languages' => 'varchar(45) default NULL',
            'geonameid' => 'varchar(45) default NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table='region';
        $this->dropTable($table);
    }

}