<?php

class m130430_045918_drop_subregion_table extends CDbMigration
{
	public function up()
	{
            $table = 'subregion';
            $this->dropTable($table);
            $table = 'region';
            $this->dropTable($table);
	}
}