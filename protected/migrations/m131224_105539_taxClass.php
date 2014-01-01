<?php

class m131224_105539_taxClass extends DTDbMigration {

    public function up() {
        $table = "tax_rates";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'city_id' => 'int(11) NOT NULL',
            'title' => 'varchar(255) NOT NULL COLLATE utf8_general_ci',
            'price_level' => 'double(12,3) DEFAULT NULL',
            'tax_rate' => 'double(12,3) DEFAULT NULL',
            'rate_type' => "enum('flat','percentage') DEFAULT NULL",
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
        $table = "tax_rates";
        $this->dropTable($table);
    }

}