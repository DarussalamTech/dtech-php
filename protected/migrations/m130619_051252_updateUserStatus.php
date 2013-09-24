<?php

class m130619_051252_updateUserStatus extends DTDbMigration {

    public function up() {
        $table = "user";
        $this->update($table, array("status_id"=>2), "status_id = 0");
    }

    public function down() {
       $table = "user";
        $this->update($table, array("status_id"=>0), "status_id = 1");
    }

}