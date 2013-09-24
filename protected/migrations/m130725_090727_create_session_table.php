<?php

class m130725_090727_create_session_table extends DTDbMigration {

    public function up() {
        $table = "session";
        $columns = array(
            'ip' => 'VARCHAR(50)  NOT NULL',
            'country_id' => 'int(11) NOT NULL',
            'city_id' => 'int(11) NOT NULL',
            'PRIMARY KEY  (`ip`)');
        $this->createTable($table, $columns);
    }

    public function down() {
        $table = "session";
        $this->dropTable($table);
    }

}