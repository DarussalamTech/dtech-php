<?php

class m140106_093621_ImportMaping extends DTDbMigration {

    public function up() {
        $table = "import_mapping";
        $this->addColumn($table, "relational_json","text DEFAULT NULL after db_cols_json");
    }

    public function down() {
        $table = "import_mapping";
        $this->dropColumn($table,"relational_json");
    }

}