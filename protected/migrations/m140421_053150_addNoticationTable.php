<?php

class m140421_053150_addNoticationTable extends DTDbMigration {

    public function up() {
        $table = "notification_folder";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(255) DEFAULT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );
        $this->createTable($table, $columns);
        $columns = array(
            "name"=>"default",
        );
        $this->insertRow($table, $columns);

        $table = "notifcation";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'from' => 'int(11) unsigned NOT NULL',
            'to' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'type' => 'enum("sent","inbox")',
            'folder' => 'int(11) DEFAULT NULL',
            'subject' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'body' => 'text DEFAULT NULL COLLATE utf8_general_ci',
            'attachment' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'related_to' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'related_id' => 'int(11) DEFAULT NULL',
            'email_sent' => 'tinyint(1) DEFAULT 0',
            'is_read' => 'tinyint(1) DEFAULT 0',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "notification_folder";
        $this->dropTable($table);

        $table = "notifcation";
        $this->dropTable($table);
    }

}