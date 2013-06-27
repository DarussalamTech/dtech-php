<?php

class m130425_051028_drop_user_id_user_profile extends CDbMigration
{

    public function up()
    {
        $table = "user_profile";
        $this->dropColumn($table, "user_id");
    }

    public function down()
    {
        $table = "user_profile";
        $this->addColumn($table, "user_id","int(11)  NOT NULL");
    }

    
}