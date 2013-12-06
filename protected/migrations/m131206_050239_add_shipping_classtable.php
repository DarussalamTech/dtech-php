<?php

class m131206_050239_add_shipping_classtable extends DTDbMigration {

    public function up() {
        $table = "shipping_class";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'source_city' => 'int(11) NOT NULL',
            'destination_city' => 'int(11) NOT NULL',
            'title' => 'varchar(255) NOT NULL COLLATE utf8_general_ci',
            'shipping_price' => 'double(12,3) DEFAULT NULL',
            'is_fix_shpping' => 'TINYINT(1) DEFAULT 0',
            'is_pirce_range' => 'TINYINT(1) DEFAULT 0',
            'start_price' => 'double(12,3) DEFAULT 0',
            'end_price' => 'double(12,3) DEFAULT 0',
            'min_weight_id' => 'int(11) DEFAULT 0',
            'max_weight_id' => 'int(11) DEFAULT 0',
            'categories' => 'varchar(255) NOT NULL COLLATE utf8_general_ci',
            'class_status' => 'TINYINT(1) DEFAULT 0',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "shipping_class";
        $this->dropTable($table);
    }

}