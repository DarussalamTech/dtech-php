<?php

class m140106_093621_ImportMaping extends DTDbMigration {

    public function up() {
        $table = "import_mapping";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'file_name' => 'varchar(255) NOT NULL COLLATE utf8_general_ci',
            'file_path' => 'varchar(255) NOT NULL COLLATE utf8_general_ci',
            'module' => 'varchar(255) NOT NULL COLLATE utf8_general_ci',
            'headers_json' => 'TEXT DEFAULT NULL',
            'db_cols_json' => 'TEXT DEFAULT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "import_mapping";
        $this->dropTable($table);
    }

}