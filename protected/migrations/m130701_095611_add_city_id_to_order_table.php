<?php

class m130701_095611_add_city_id_to_order_table extends CDbMigration {

    public function up() {
        $table = "order";
        $this->addColumn($table, "city_id", "int(11) NOT NULL after user_id");
    }

    public function down() {
        $table = "order";
        $this->dropColumn($table, "city_id");
    }

}