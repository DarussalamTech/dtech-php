<?php

class m130715_102045_add_aclRules extends CDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Categories.CreateParent",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Categories.UpdateParent",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Categories.IndexParent",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Categories.*",
            "child" => "Categories.CreateParent",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Categories.*",
            "child" => "Categories.UpdateParent",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Categories.*",
            "child" => "Categories.IndexParent",
        );
        $this->insert($table, $columns);

        //-------------

        $table = "rights";
        $columns = array(
            "itemname" => "Categories.CreateParent",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Categories.UpdateParent",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Categories.IndexParent",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Categories.CreateParent'");
        $this->delete($table, "name='Categories.UpdateParent'");
        $this->delete($table, "name='Categories.IndexParent'");

        $table = "authitemchild";
        $this->delete($table, "child='Categories.CreateParent'");
        $this->delete($table, "child='Categories.UpdateParent'");
        $this->delete($table, "child='Categories.IndexParent'");

        $table = "rights";
        $this->delete($table, "itemname='Categories.CreateParent'");
        $this->delete($table, "itemname='Categories.UpdateParent'");
        $this->delete($table, "itemname='Categories.IndexParent'");
    }

}