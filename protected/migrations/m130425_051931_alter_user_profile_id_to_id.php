<?php

class m130425_051931_alter_user_profile_id_to_id extends CDbMigration
{

    public function up()
    {
        $table = "user_profile";
        $this->renameColumn($table,'user_profile_id','id');
        $this->alterColumn($table, "id", "INT( 11 ) NOT NULL");
    }

    public function down()
    {
        $table = "user_profile";
       $this->renameColumn($table,'id','user_profile_id');
        $this->alterColumn($table, "user_profile_id", "INT( 11 ) NOT NULL AUTO_INCREMENT");
    }

}