<?php

class m130611_093749_create_table_user_order_shipping extends CDbMigration {

    public function up() {
        $table = "user_order_shipping";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(11) NOT NULL',
            'order_id' => 'int(11) NOT NULL',
            'shipping_prefix' => 'varchar(3) NULL',
            'shipping_first_name' => 'varchar(255) NULL',
            'shipping_last_name' => 'varchar(255) NULL',
            'shipping_address1' => 'varchar(255) NULL',
            'shipping_address2' => 'varchar(255) NULL',
            'shipping_country' => 'varchar(255) NULL',
            'shipping_state' => 'varchar(255) NULL',
            'shipping_city' => 'varchar(255) NULL',
            'shipping_zip' => 'int(11) NULL',
            'shipping_phone' => 'varchar(255) NULL',
            'shipping_mobile' => 'varchar(255) NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "user_order_shipping";
        $this->dropTable($table);
    }

}