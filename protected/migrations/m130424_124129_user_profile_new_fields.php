<?php

class m130424_124129_user_profile_new_fields extends CDbMigration
{
	public function up() {
        $table = "user_profile";
        $this->addColumn($table, "date_of_birth", "date  DEFAULT NULL");
        $this->addColumn($table, "address_2", "varchar(255)  DEFAULT NULL");
        $this->addColumn($table, "country", "varchar(255)  DEFAULT NULL");
        $this->addColumn($table, "zip_code", "int(11)  DEFAULT NULL");
    }

    public function down() {
        $table = "user_profile";
        $this->dropColumn($table, "date_of_birth", "date  DEFAULT NULL");
        $this->dropColumn($table, "address_2", "varchar(255)  DEFAULT NULL");
        $this->dropColumn($table, "country", "varchar(255)  DEFAULT NULL");
        $this->dropColumn($table, "zip_code", "int(11)  DEFAULT NULL");
    }
}