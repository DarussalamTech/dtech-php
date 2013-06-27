<?php

class m130513_064132_add_price_column_product_profile extends DTDbMigration {

    public function up() {
        $table = "product_profile";
        $this->addColumn($table, "price", "double(12,3) DEFAULT NULL after language_id");
    }

    public function down() {
        $table = "product_profile";
        $this->dropColumn($table, "price");
    }

}