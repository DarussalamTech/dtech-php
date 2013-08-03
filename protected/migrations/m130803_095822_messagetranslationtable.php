<?php

class m130803_095822_messagetranslationtable extends DTDbMigration {

    public function up() {
        $table = "dt_messages";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'category' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'message' => 'text DEFAULT NULL COLLATE utf8_general_ci',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "dt_messages";
        $this->dropTable($table);
    }

}