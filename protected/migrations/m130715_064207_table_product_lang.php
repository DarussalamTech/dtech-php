<?php

class m130715_064207_table_product_lang extends DTDbMigration {

    public function up() {
        $table = "product_lang";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'product_id' => 'int(11) NOT NULL',
            'product_name' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'product_description' => 'longtext DEFAULT NULL COLLATE utf8_general_ci',
            'product_overview' => 'text DEFAULT NULL COLLATE utf8_general_ci',
            'product_overview' => 'text DEFAULT NULL COLLATE utf8_general_ci',
            'lang_id' => 'varchar(6) DEFAULT NULL COLLATE utf8_general_ci',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "product_lang";
        $this->dropTable($table);
    }

}