<?php

class m140317_100400_convertDhlTozonrRates extends DTDbMigration {

    public function up() {
        $table = "dhl_rates_history";
        $this->renameTable($table, "zone_rates_history");

        $table = "dhl_rates";
        $this->renameTable($table, "zone_rates");
        
        $this->addColumn("zone_rates", "rate_type", "varchar(255) DEFAULT NULL after city_id");
    }

    public function down() {

        $table = "zone_rates_history";
        $this->renameTable($table, "dhl_rates_history");

        $table = "zone_rates";
        $this->renameTable($table, "dhl_rates");
        
        $this->dropColumn("dhl_rates", "rate_type");
    }

}