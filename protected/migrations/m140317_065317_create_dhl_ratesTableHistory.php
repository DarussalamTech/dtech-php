<?php

class m140317_065317_create_dhl_ratesTableHistory extends DTDbMigration {

    public function up() {
        $table = "dhl_rates_history";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'rate' => 'decimal(10,4)  DEFAULT NULL',
            'rate_id' => 'int(11) DEFAULT NULL',
            'create_time' => 'datetime NOT NULL',
            'create_user_id' => 'int(11) unsigned NOT NULL',
            'update_time' => 'datetime NOT NULL',
            'update_user_id' => 'int(11) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
        );
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "dhl_rates_history";
        $this->dropTable($table);
    }

}