<?php

class m130702_092225_language_title_product_profile extends DTDbMigration {

    public function up() {
        $table = "product_profile";
        $this->addColumn($table, "title", "varchar(255) DEFAULT NULL after language_id");
    }

    public function down() {
        $table = "product_profile";
        $this->dropColumn($table, "title");
    }

}