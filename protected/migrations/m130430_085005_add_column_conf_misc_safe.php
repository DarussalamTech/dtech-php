<?php

class m130430_085005_add_column_conf_misc_safe extends DTDbMigration {

    public function up() {
        $table = "conf_misc";
        $columns = $this->getcolumns($table);

        $column = "create_time";
        if (!in_array($column, $columns)) {
            $this->addColumn($table, $column, "datetime NOT NULL");
        }

        $column = "create_user_id";
        if (!in_array($column, $columns)) {
            $this->addColumn($table, $column, "int(11) unsigned NOT NULL");
        }

        $column = "update_time";
        if (!in_array($column, $columns)) {
            $this->addColumn($table, $column, "datetime NOT NULL");
        }

        $column = "update_user_id";
        if (!in_array($column, $columns)) {
            $this->addColumn($table, $column, "int(11) unsigned NOT NULL");
        }

        $column = "activity_log";
        if (!in_array($column, $columns)) {
            $this->addColumn($table, $column, "text DEFAULT NULL");
        }
    }

    public function down() {
        $table = "conf_misc";
        $columns = $this->getcolumns($table);

        $column = "create_time";
        if (in_array($column, $columns)) {
            $this->dropColumn($table, $column);
        }

        $column = "create_user_id";
        if (in_array($column, $columns)) {
            $this->dropColumn($table, $column);
        }

        $column = "update_time";
        if (in_array($column, $columns)) {
            $this->dropColumn($table, $column);
        }

        $column = "update_user_id";
        if (in_array($column, $columns)) {
            $this->dropColumn($table, $column);
        }

        $column = "activity_log";
        if (in_array($column, $columns)) {
            $this->dropColumn($table, $column);
        }
    }

}