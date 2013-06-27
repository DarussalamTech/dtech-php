<?php

class m130502_102413_add_special_offers_column_user_table extends CDbMigration
{
	public function up()
	{
            $table = "user";
        $this->addColumn($table, "special_offer", "TINYINT( 11 ) NOT NULL");
	}

	public function down()
	{
		$table = "user";
        $this->dropColumn($table, "special_offer", "TINYINT( 11 ) NOT NULL");
	}

}