<?php

class m130603_052932_add_column_typeINmisc extends CDbMigration {

    public function up() {
        $table = "conf_misc";
        $this->addColumn($table, "misc_type", "enum('general','other') DEFAULT NULL after field_type");
    }

    public function down() {
        $table = "conf_misc";
        $this->dropColumn($table, "misc_type");
    }

}