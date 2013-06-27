<?php

class m130610_085721_add_column_inDiscount extends CDbMigration {

    public function up() {
        $table = "product_discount";
        $this->addColumn($table, "applied", "tinyint(1) DEFAULT 0 after discount_value");
    }

    public function down() {
        $table = "product_discount";
        $this->dropColumn($table, "applied");
    }

}