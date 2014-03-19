<?php

class m140317_063938_create_dhl_ratesTable extends DTDbMigration {

    public function up() {
        $table = "dhl_rates";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'weight' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'zone_id' => 'varchar(255) DEFAULT NULL COLLATE utf8_general_ci',
            'rate' => 'varchar(50)  DEFAULT NULL',
            'city_id' => 'int(11) DEFAULT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );
       $this->createTable($table, $columns);
    }

    public function down() {
        $table = "dhl_rates";
        $this->dropTable($table);
    }

}