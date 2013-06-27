<?php

class m130422_133105_product_rev_rating extends CDbMigration {

    public function up() {
        $table = "product_reviews";
        $this->addColumn($table, "rating", "int(11) DEFAULT NULL");
    }

    public function down() {
        $table = "product_reviews";
        $this->dropColumn($table, "rating");
     }

}