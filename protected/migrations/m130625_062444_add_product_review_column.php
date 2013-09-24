<?php

class m130625_062444_add_product_review_column extends CDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "product_overview", "TEXT NOT NULL after product_description");
    }

    public function down() {
        $table = "product";
        $this->dropColumn($table, "product_overview");
    }

}