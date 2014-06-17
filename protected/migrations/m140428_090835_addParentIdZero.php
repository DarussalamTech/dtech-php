<?php

class m140428_090835_addParentIdZero extends DTDbMigration {

    public function up() {
        $table = "product";
        $this->addColumn($table, "parent_id", "int(11)  DEFAULT 0 after universal_name");
    }

    public function down() {
        $table = "product";
        $this->dropColumn($table, "parent_id");
    }


}