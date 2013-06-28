<?php

class m130628_073120_removeRoletablerelation extends DTDbMigration {

    public function up() {
        $table = "user";
        $this->dropForeignKey("user_ibfk_2", $table);
        $this->dropTable("user_role");
    }

    public function down() {
        $table = "user";
        $columns = array(
              'role_id'=>'int(11) NOT NULL AUTO_INCREMENT',
              'role_title'=>'varchar(255) NOT NULL',
              'create_time'=>'datetime NOT NULL',
              'create_user_id'=>'int(11) unsigned NOT NULL',
              'update_time'=>'datetime NOT NULL',
              'update_user_id'=>'int(11) unsigned NOT NULL',
              'PRIMARY KEY (`role_id`)',
        );
        $this->createTable("user_role", $columns);
        //$this->addForeignKey("user_role_fk", $table,"role_id","user_role","role_id");
    }

}