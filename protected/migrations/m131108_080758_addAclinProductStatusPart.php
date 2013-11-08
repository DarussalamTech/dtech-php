<?php

class m131108_080758_addAclinProductStatusPart extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Product.ToggleEnabled",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //------------- *****//
        $table = "authitemchild";
  
        //-------------
        $columns = array(
            "parent" => "Product.Update",
            "child" => "Product.ToggleEnabled",
        );
        $this->insert($table, $columns);
        //-------------

        $table = "rights";
        $columns = array(
            "itemname" => "Product.ToggleEnabled",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Product.ToggleEnabled'");
    
        $table = "authitemchild";
        $this->delete($table, "child='Product.ToggleEnabled'");


        $table = "rights";
        $this->delete($table, "itemname='Product.ToggleEnabled'");

    }

}