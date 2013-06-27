<?php

class m130509_101648_add_new_fields_product_profile extends CDbMigration {

    public function up() {
        $table = "product_profile";
        $this->renameColumn($table, "profile_id", "id");

        $this->addColumn($table, "item_code", "varchar(255) NOT NULL after id");
        $this->addColumn($table, "language_id", "int(11) NOT NULL after item_code");
        $this->addColumn($table, "size", "varchar(255) NOT NULL after language_id");
        $this->addColumn($table, "no_of_pages", "int(11) DEFAULT NULL after size");
        $this->addColumn($table, "binding", "varchar(255) DEFAULT NULL after no_of_pages");
        $this->addColumn($table, "printing", "varchar(255) DEFAULT NULL after binding");
        $this->addColumn($table, "paper", "varchar(255) DEFAULT NULL after printing");
        $this->addColumn($table, "edition", "varchar(255) NOT NULL after paper");
    }

    public function down() {
        $table = "product_profile";

        $this->renameColumn($table, "id", "profile_id");

        $this->dropColumn($table, "item_code");
        $this->dropColumn($table, "language_id");
        $this->dropColumn($table, "size");
        $this->dropColumn($table, "no_of_pages");
        $this->dropColumn($table, "binding");
        $this->dropColumn($table, "printing");
        $this->dropColumn($table, "paper");
        $this->dropColumn($table, "edition");
    }

}