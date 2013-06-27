<?php

class m130424_121650_new_field_to_userPro_province extends CDbMigration
{
	public function up()
	{
            $table = "user_profile";
        $this->addColumn($table, "state_province", "varchar(255)  DEFAULT NULL");
	}

	public function down()
	{
		$table = "user_profile";
        $this->dropColumn($table, "state_province", "varchar(255)  DEFAULT NULL");
	}

	
}