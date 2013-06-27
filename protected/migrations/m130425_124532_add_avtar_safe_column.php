<?php

class m130425_124532_add_avtar_safe_column extends DTDbMigration
{

    public function up()
    {
        $table = "user_profile";
        $columns = $this->getcolumns($table);
        $column = "avatar";
        if (!in_array($column, $columns))
        {
            $this->addColumn($table, $column, "varchar(255) NOT NULL");
        }
    }

    public function down()
    {
        $table = "user_profile";
        $columns = $this->getcolumns($table);
        $column = "avatar";
        if (in_array($column, $columns))
        {
            $this->dropColumn($table, $column);
        }
    }

}