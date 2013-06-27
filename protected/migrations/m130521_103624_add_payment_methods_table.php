<?php

class m130521_103624_add_payment_methods_table extends DTDbMigration {

    public function up() {
        $table = "payment_methods";
        $columns = array(
            'id' => 'int(10) unsigned NOT NULL auto_increment',
            'name' => 'varchar(255) NOT NULL',
            'status' => 'enum("Disable","Enable") DEFAULT "Disable"',
            'sandbox' => 'enum("Disable","Enable") DEFAULT "Enable"',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'activity_log' => 'text',
            'PRIMARY KEY  (`id`)');
       $this->createTable($table, $columns);
    }

    public function down() {
        $table = "payment_methods";
        $this->dropTable($table);
    }

}