<?php

class m130828_094636_add_billing_table extends CDbMigration {

    public function up() {
        $table = "user_order_billing";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(11) NOT NULL',
            'order_id' => 'int(11) NOT NULL',
            'billing_prefix' => 'varchar(3) NULL',
            'billing_first_name' => 'varchar(255) NULL',
            'billing_last_name' => 'varchar(255) NULL',
            'billing_address1' => 'varchar(255) NULL',
            'billing_address2' => 'varchar(255) NULL',
            'billing_country' => 'varchar(255) NULL',
            'billing_state' => 'varchar(255) NULL',
            'billing_city' => 'varchar(255) NULL',
            'billing_zip' => 'int(11) NULL',
            'billing_phone' => 'varchar(255) NULL',
            'billing_mobile' => 'varchar(255) NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "user_order_billing";
        $this->dropTable($table);
    }

}