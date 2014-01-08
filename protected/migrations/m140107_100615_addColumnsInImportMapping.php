<?php

class m140107_100615_addColumnsInImportMapping extends DTDbMigration {

    public function up() {
        $table = "import_mapping";
        $this->addColumn($table, "category", "int(11) unsigned NOT NULL after module");
        $this->addColumn($table, "city_id", "int(11) unsigned NOT NULL after category");
        $this->addColumn($table, "total_steps", "int(11) DEFAULT 0 after city_id");
        $this->addColumn($table, "completed_steps", "int(11) DEFAULT 0 after total_steps");
        $this->addColumn($table, "sheet", "int(11) DEFAULT 0 after completed_steps");
    }

    public function down() {
        $table = "import_mapping";
        $this->dropColumn($table, "category");
        $this->dropColumn($table, "city_id");
        $this->dropColumn($table, "total_steps");
        $this->dropColumn($table, "completed_steps");
        $this->dropColumn($table, "sheet");
    }

}