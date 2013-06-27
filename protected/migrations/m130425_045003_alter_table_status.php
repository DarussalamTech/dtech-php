<?php

class m130425_045003_alter_table_status extends DTDbMigration
{

    public function up()
    {
        $table = "status";
        $this->dropForeignKey("user_ibfk_3", "user");
     
        $this->dropTable($table);
    }

    public function down()
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

}