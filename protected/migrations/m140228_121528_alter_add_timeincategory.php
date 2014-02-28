<?php

class m140228_121528_alter_add_timeincategory extends DTDbMigration {

    public function up() {
        $table = "categories";
        $this->alterColumn($table, "added_date", "varchar(255) DEFAULT NULL");
    }

    public function down() {
        $table = "categories";
        $this->alterColumn($table, "added_date", "varchar(255) NOT NULL");
    }

}