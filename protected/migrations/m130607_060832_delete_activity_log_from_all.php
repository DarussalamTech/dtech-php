<?php

class m130607_060832_delete_activity_log_from_all extends DTDbMigration {

    public function up() {
        $tables = $this->getTables();

        foreach ($tables as $table) {
            //echo $table;
            $columns = $this->getcolumns($table);
            if (in_array('activity_log', $columns)) {
                $this->dropColumn($table, 'activity_log');
            }
        }
    }

    public function down() {
        $tables = $this->getTables();
        foreach ($tables as $table) {
            $this->addColumn($table, 'activity_log', 'text DEFAULT NULL');
        }
    }

}