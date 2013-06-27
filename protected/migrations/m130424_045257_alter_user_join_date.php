<?php

class m130424_045257_alter_user_join_date extends CDbMigration
{

    public function up()
    {
        $table = "user";
        $this->alterColumn($table, "join_date", "date NOT NULL");
    }

    public function down()
    {
        $table = "user";
        $this->alterColumn($table, "join_date", "varchar(255) NOT NULL");
    }

}