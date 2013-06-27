<?php

class m130624_093750_installRightsMod extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            'name' => 'varchar(250) NOT NULL',
            'type' => 'int(11) NOT NULL',
            'description' => 'text',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (`name`)',
        );
        $this->createTable($table, $columns);


        $table = "authitemchild";
        $columns = array(
            'parent' => 'varchar(250) NOT NULL',
            'child' => 'varchar(250) NOT NULL',
            'PRIMARY KEY (`parent`,`child`)',
        );
        $this->createTable($table, $columns);

        $table = "authassignment";
        $columns = array(
            'itemname' => 'varchar(250) NOT NULL',
            'userid' => 'varchar(250) NOT NULL',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (`itemname`,`userid`)',
        );
        $this->createTable($table, $columns);

        $table = "rights";
        $columns = array(
            'itemname' => 'varchar(250) NOT NULL',
            'type' => 'int(11) NOT NULL',
            'weight' => 'int(11) NOT NULL',
            'PRIMARY KEY (`itemname`)',
        );
        $this->createTable($table, $columns);
    }

    public function down() {
        $this->dropTable("authitem");
        $this->dropTable("authitemchild");
        $this->dropTable("authassignment");
        $this->dropTable("rights");
    }

}