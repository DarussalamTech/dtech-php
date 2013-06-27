<?php

class m130424_132933_remove_profile_relationship extends CDbMigration
{

    public function up()
    {
        $table = "user_profile";
        $this->dropForeignKey("user_profile_ibfk_1", $table);
    }

    public function down()
    {
        $table = "user_profile";
        $this->addForeignKey("user_profile_ibfk_1", $table,'user_id','user','user_id');
    }

}