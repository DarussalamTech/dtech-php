<?php

class m140508_051811_creatfromsliderINACL extends DTDbMigration {

    public function up() {
        
        $table = "authitem";
        $columns = array(
            "name" => "Product.CreateFromTemplate",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Product.*",
            "child" => "Product.CreateFromTemplate",
        );
        $this->insert($table, $columns);


        //
        $table = "rights";
        $columns = array(
            "itemname" => "Product.CreateFromTemplate",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Product.CreateFromTemplate'");

        $table = "authitemchild";
        $this->delete($table, "child='Product.CreateFromTemplate'");

        $table = "rights";
        $this->delete($table, "itemname='Product.CreateFromTemplate'");
    }

}