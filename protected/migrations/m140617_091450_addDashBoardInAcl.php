<?php

class m140617_091450_addDashBoardInAcl extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "DashBoard.*",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "DashBoard.Index",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);


//
//        /********************************************************/
        $table = "authitemchild";
        $columns = array(
            "parent" => "DashBoard.*",
            "child" => "DashBoard.Index",
        );
        $this->insert($table, $columns);
      
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "DashBoard.*",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "DashBoard.Index",
            "type" => "0",
        );
        $this->insert($table, $columns);


       
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='DashBoard.*'");
        $this->delete($table, "name='DashBoard.Index'");

        $table = "authitemchild";
        $this->delete($table, "child='DashBoard.Index'");
        
        $table = "rights";
        $this->delete($table, "itemname='DashBoard.*'");
        $this->delete($table, "itemname='DashBoard.Index'");
    }

}