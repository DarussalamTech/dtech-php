<?php

class m131205_045754_add_weightColumn extends DTDbMigration {

    public function up() {
        $table = "conf_products";
        $this->alterColumn($table, "type", "enum('Dimensions', 'Binding', 'Printing', 'Paper','weight')");
    }

    public function down() {
        $table = "conf_products";
        $this->alterColumn($table, "type", "enum('Dimensions', 'Binding', 'Printing', 'Paper')");
    }

}