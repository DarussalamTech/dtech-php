<?php

class m130905_104703_addsystem_orderinnauthorandcateorgoes extends DTDbMigration {

    public function up() {
        
        $table = "author";
        $this->addColumn($table, "user_order", "int(4) DEFAULT 0 after author_name");
        
        $table = "categories";
        $this->addColumn($table, "user_order", "int(4) DEFAULT 0 after  is_main_featured");
    }

    public function down() {
        $tables = array("author","categories");
        foreach($tables as $table){
            $this->dropColumn($table,"user_order");
        }
    }

}