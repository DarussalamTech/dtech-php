<?php

class m140317_073914_addRleationbetweenOrderandOrderHistory extends DTDbMigration {

    public function up() {
        $table = "dhl_rates_history";
        $this->addForeignKey("fk".$table, $table, "rate_id", "dhl_rates", "id", "CASCADE", "CASCADE");
    }

    public function down() {
        $table = "dhl_rates_history";
        $this->dropForeignKey("fk".$table, $table);
    }

}