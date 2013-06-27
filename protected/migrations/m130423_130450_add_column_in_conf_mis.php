<?php

class m130423_130450_add_column_in_conf_mis extends CDbMigration {

    public function up() {
        $table = "conf_misc";
        $this->dropColumn($table, "create_time");
        $this->dropColumn($table, "create_user_id");
        $this->dropColumn($table, "update_time");
        $this->dropColumn($table, "update_user_id");

        /** adding two new columns * */
        $this->addColumn($table, "site_id", "int(11) unsigned NOT NULL");
        $this->addColumn($table, "city_id", "int(11) unsigned NOT NULL");
    }

    public function down() {

        $table = "conf_misc";
         
        $this->addColumn($table, "create_time", "datetime NOT NULL");
        $this->addColumn($table, "create_user_id", "int(11) unsigned NOT NULL");
        $this->addColumn($table, "update_time", "datetime NOT NULL");
        $this->addColumn($table, "update_user_id", "int(11) unsigned NOT NULL");

        /** droping two new columns * */
        $this->dropColumn($table, "site_id");
        $this->dropColumn($table, "city_id");
    }

}