<?php

class m130425_051736_alter_table_status_second extends DTDbMigration
{

    public function up()
    {
        $table = "status";
        $columns = array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(255) DEFAULT NULL',
            'module' => 'varchar(255) DEFAULT NULL',
            'PRIMARY KEY (`id`)',
        );

        $this->createTable($table, $columns);
    }

    public function down()
    {
        $table = "status";
        $this->dropTable($table);
    }

}