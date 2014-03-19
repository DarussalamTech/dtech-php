<?php

class m140317_061016_createZonetable extends DTDbMigration {

    public function up() {
        $table = "zone";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "zone";
        $this->dropTable($table);
    }

}