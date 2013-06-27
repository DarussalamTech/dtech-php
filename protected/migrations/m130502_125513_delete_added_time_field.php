<?php

class m130502_125513_delete_added_time_field extends CDbMigration {

    public function up() {
        $table = "product";
        $this->dropColumn($table, "added_date");
    }

    public function down() {
        $table = "product";
         $this->addColumn($table, "varchar(255) NOT NULL after city_id");
    }

}