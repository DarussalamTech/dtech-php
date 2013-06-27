<?php

class m130425_065850_add_data_instatus extends CDbMigration
{

    public function up()
    {
        $table = "status";
        $columns = array(
            "title" => "active",
            "module" => "User"
        );
        $this->insert($table, $columns);

        $columns = array(
            "title" => "inactive",
            "module" => "User"
        );
        $this->insert($table, $columns);
    }

    public function down()
    {
        $table = "status";
        $this->delete($table, "module='User' AND title='active'");
        $this->delete($table, "module='User' AND title='inactive'");
    }

}