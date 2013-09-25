<?php

class m130925_065340_add_statusincityandcountry extends DTDbMigration {

    public function up() {
        $table = "country";
        /**
         * 1 = enabled
         * 0 = disabled
         */
        $this->addColumn($table, "c_status", "tinyint(1) DEFAULT 1 after site_id");
        
         $table = "city";
        /**
         * 1 = enabled
         * 0 = disabled
         */
        $this->addColumn($table, "c_status", "tinyint(1) DEFAULT 1 after  	short_name 	");
    }

    public function down() {
        $table = "country";
        /**
         * 1 = enabled
         * 0 = disabled
         */
        $this->dropColumn($table, "c_status");
        $this->dropColumn("city", "c_status");
    }

}