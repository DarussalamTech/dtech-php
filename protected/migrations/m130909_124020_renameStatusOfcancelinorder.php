<?php

class m130909_124020_renameStatusOfcancelinorder extends DTDbMigration {

    public function up() {
        $table = "status";
        $this->update($table, array("title"=>"Cancelled"), "title='Canceled'");
    }

    public function down() {
        $table = "status";
        $this->update($table, array("title"=>"Canceled"), "title='Cancelled'");
    }

}