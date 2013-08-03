<?php

class m130803_101310_translationMessage extends DTDbMigration {

    public function up() {
        $table = "dt_messages_translations";
        $columns = array(
            'id' => 'int(11) NOT NULL',
            'language' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'message' => 'text DEFAULT NULL COLLATE utf8_general_ci',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`,`language`)',
        );

        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "dt_messages_translations";
        $this->dropTable($table);
    }

}