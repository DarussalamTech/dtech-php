<?php

class m130610_083903_alter_tableDiscount extends DTDbMigration {

    public function up() {
        $table = "product_discount";
        $this->renameColumn($table, "discount_id", "id");
    }

    public function down() {
        $table = "product_discount";
        $this->renameColumn($table, "id", "discount_id");
    }

}