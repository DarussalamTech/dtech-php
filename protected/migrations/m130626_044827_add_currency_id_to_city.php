<?php

class m130626_044827_add_currency_id_to_city extends CDbMigration {

    public function up() {
        $table = "city";
        $this->addColumn($table, "currency_id", "int(10)   NOT NULL after country_id");
    }

    public function down() {
        $table = "city";
        $this->dropColumn($table, 'currency_id');
    }

}