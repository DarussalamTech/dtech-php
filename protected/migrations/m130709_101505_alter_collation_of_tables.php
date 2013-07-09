<?php

class m130709_101505_alter_collation_of_tables extends DTDbMigration {

    public function up() {
        $table = "product";
        $this->alterColumn($table, "product_name", "varchar(255) NOT NULL COLLATE utf8_general_ci");

        $this->alterColumn($table, "product_description", "longtext DEFAULT NULL COLLATE utf8_general_ci");
        $this->alterColumn($table, "product_overview", "text DEFAULT NULL COLLATE utf8_general_ci");

        $this->alterColumn("product_profile", "title", "varchar(255) DEFAULT NULL COLLATE utf8_general_ci");

        $this->alterColumn("categories", "category_name", "varchar(255) DEFAULT NULL COLLATE utf8_general_ci");
    }

    public function down() {

        return true;
    }

}