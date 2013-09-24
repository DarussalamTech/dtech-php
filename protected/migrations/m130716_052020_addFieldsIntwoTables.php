<?php

class m130716_052020_addFieldsIntwoTables extends CDbMigration {

    public function up() {
        $table = "product_profile_lang";
        $this->addColumn($table, "lang_id", 'varchar(6) DEFAULT NULL COLLATE utf8_general_ci after title');

        $table = "categories_lang";
        $this->addColumn($table, "lang_id", 'varchar(6) DEFAULT NULL COLLATE utf8_general_ci after category_name');
    }

    public function down() {
        $table = "product_profile_lang";

        $this->dropColumn($table, "lang_id");

        $table = "categories_lang";

        $this->dropColumn($table, "lang_id");
    }

}