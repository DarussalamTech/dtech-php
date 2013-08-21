<?php

class m130821_094511_add_slider_page extends DTDbMigration {

    public function up() {
        $table = "slider";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'image' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'title' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'product_id' => 'int(11) NOT NULL',
            'city_id' => 'int(11) NOT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "slider";
        $this->dropTable($table);
    }

}