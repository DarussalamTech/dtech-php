<?php

class m140513_090157_storeLogErrors extends DTDbMigration {

    public function up() {
        $table = "log";
        $this->addColumn($table, "line", "varchar(15) DEFAULT NULL after url");
        $this->addColumn($table, "file", "varchar(100) DEFAULT NULL after line");
        $this->addColumn($table, "message", "varchar(200) DEFAULT NULL after file");
        $this->addColumn($table, "type", "varchar(15) DEFAULT NULL after message");
        $this->addColumn($table, "trace", "text after type");
        $this->dropColumn($table, "product_id");
        $this->dropColumn($table, "user_id");
        $this->dropColumn($table, "action");
        $this->renameColumn($table, "log_id", "id");

        $this->addColumn($table, "htaccess_rule", "varchar(300) DEFAULT NULL after file");
        $this->addColumn($table, "robots_txt_rule", "varchar(300) DEFAULT NULL after file");
        
        $this->dropColumn($table, "user_name");
        $this->dropColumn($table, "added_date");
    }

    public function down() {
        $table = "log";

        $this->dropColumn($table, "htaccess_rule");
        $this->dropColumn($table, "robots_txt_rule");

        $this->dropColumn($table, "line");
        $this->dropColumn($table, "file");
        $this->dropColumn($table, "message");
        $this->dropColumn($table, "type");
        $this->dropColumn($table, "trace");
        $this->renameColumn($table, "id", "log_id");

        $this->addColumn($table, "product_id", "int(11) DEFAULT NULL after log_id");
        $this->addColumn($table, "user_id", "int(11) DEFAULT NULL after product_id");
        $this->addColumn($table, "action", "varchar(15) DEFAULT NULL after user_id");
        $this->addColumn($table, "added_date", "int(11) DEFAULT NULL after action");
        $this->addColumn($table, "user_name", "varchar(15) DEFAULT NULL after added_date");
    }

}