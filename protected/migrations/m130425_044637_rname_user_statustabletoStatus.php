<?php

class m130425_044637_rname_user_statustabletoStatus extends CDbMigration
{

    public function up()
    {
        $table = "user_status";
        $this->renameTable($table, "status");
    }

    public function down()
    {
        $table = "status";
        $this->renameTable($table, "user_status");
    }

}