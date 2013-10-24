<?php

class m131023_124324_insertLanguageKeywordInheader extends DTDbMigration {

    public function up() {
        $table = "dt_messages";
        $this->insertRow($table, array("category" => "header_footer", "message" => "Shipment & Payment"));
    }

    public function down() {
        $table = "dt_messages";
        $this->delete($table, "category='header_footer' AND message='Shipment & Payment'");
    }

}