<?php

class m131107_100314_add_status_fieldProduct extends DTDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "status", "TINYINT( 11 ) DEFAULT 1 after product_overview");
    }

    public function down() {
        $table = "product";
        $this->dropColumn($table, "status");
    }

}