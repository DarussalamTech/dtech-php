<?php

class m140317_062916_alterCountriesTable extends DTDbMigration {

    public function up() {
         $table = "country";
         $this->addColumn($table, "dhl_code", "varchar(10) DEFAULT NULL COLLATE utf8_general_ci after c_status" );
         $this->addColumn($table, "zone_id", "int(11) DEFAULT NULL after dhl_code");
    }

    public function down() {
         $table = "country";
         $this->dropColumn($table, "dhl_code");
         $this->dropColumn($table, "zone_id");
    }

}