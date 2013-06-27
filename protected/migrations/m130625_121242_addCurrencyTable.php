<?php

class m130625_121242_addCurrencyTable extends DTDbMigration {
    

    function up() {
        $table = "currency";
        $columns = array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'name' => 'varchar(255) NOT NULL',
            'symbol' => 'varchar(15) NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "currency";
        $this->dropTable($table);
    }

}