<?php

class m131205_093500_shippable_countries extends DTDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "shippable_countries", "varchar(900) DEFAULT NULL after authors");
    }

    public function down() {
        $table = "product";
        $this->dropColumn($table, "shippable_countries");
    }

}