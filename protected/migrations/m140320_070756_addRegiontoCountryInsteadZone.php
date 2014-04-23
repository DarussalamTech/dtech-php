<?php

class m140320_070756_addRegiontoCountryInsteadZone extends DTDbMigration {

    public function up() {
        $table = "region";
        $this->addColumn($table, "dhl_code", "varchar(10) DEFAULT NULL COLLATE utf8_general_ci after  	status");
        $this->addColumn($table, "zone_id", "int(11) DEFAULT NULL after dhl_code");
    }

    public function down() {
        $table = "region";
        $this->dropColumn($table, "dhl_code");
        $this->dropColumn($table, "zone_id");
    }

}