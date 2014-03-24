<?php

class m140324_111636_currencyTotalInorder extends DTDbMigration {

    public function up() {
        $table = "order";
        $this->addColumn($table, "currency_amount", "decimal(10,4) DEFAULT NULL after total_price");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "currency_amount");
    }

}