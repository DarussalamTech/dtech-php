<?php

class m130701_114342_create_table_product_attributes extends CDbMigration {

    public function up() {
        $table = "product_attributes";
        $columns = array(
            'id' => 'int(11)  NOT NULL auto_increment',
            'product_attribute_conf_id' => 'int(11) NOT NULL',
            'product_profile_id' => 'int(11) NOT NULL',
            'attribute_value' => 'varchar(255) NOT NULL',
            'price' => 'double(12,3) DEFAULT NULL',
            
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY  (`id`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "product_attributes";
        $this->dropTable($table);
    }

}