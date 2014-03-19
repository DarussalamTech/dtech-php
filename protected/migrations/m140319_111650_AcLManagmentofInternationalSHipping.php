<?php

class m140319_111650_AcLManagmentofInternationalSHipping extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Zone.*",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Zone.Create",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Zone.Update",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Zone.Index",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Zone.Delete",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        $table = "authitem";
        $columns = array(
            "name" => "Zone.View",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //zone view

        $table = "authitem";
        $columns = array(
            "name" => "Zone.LoadChildByAjax",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //zone view

        $table = "authitem";
        $columns = array(
            "name" => "Zone.EditChild",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //zone view

        $table = "authitem";
        $columns = array(
            "name" => "Zone.DeleteChildByAjax",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.*",
            "child" => "Zone.Create",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.*",
            "child" => "Zone.Update",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.*",
            "child" => "Zone.Delete",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Create",
            "child" => "Zone.Index",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Create",
            "child" => "Zone.LoadChildByAjax",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Update",
            "child" => "Zone.Index",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Update",
            "child" => "Zone.EditChild",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Delete",
            "child" => "Zone.Index",
        );
        $this->insert($table, $columns);

        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Delete",
            "child" => "Zone.DeleteChildByAjax",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Zone.Index",
            "child" => "Zone.View",
        );
        $this->insert($table, $columns);

        //--------Rights-----

        $table = "rights";
        $columns = array(
            "itemname" => "Zone.*",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Zone.Create",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Zone.Update",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Zone.Index",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Zone.Delete",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Zone.View",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //three other child data insertion updating deleion actions

        $table = "rights";
        $columns = array(
            "itemname" => "Zone.LoadChildByAjax",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Zone.EditChild",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Zone.DeleteChildByAjax",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Zone.*'");
        $this->delete($table, "name='Zone.Create'");
        $this->delete($table, "name='Zone.Update'");
        $this->delete($table, "name='Zone.Delete'");
        $this->delete($table, "name='Zone.Index'");
        $this->delete($table, "name='Zone.View'");
        $this->delete($table, "name='Zone.DeleteChildByAjax'");
        $this->delete($table, "name='Zone.EditChild'");
        $this->delete($table, "name='Zone.LoadChildByAjax'");


        $table = "authitemchild";
        $this->delete($table, "child='Zone.Create'");
        $this->delete($table, "child='Zone.Update'");
        $this->delete($table, "child='Zone.Delete'");
        $this->delete($table, "child='Zone.Index'");
        $this->delete($table, "child='Zone.View'");

        $this->delete($table, "child='Zone.DeleteChildByAjax'");
        $this->delete($table, "child='Zone.EditChild'");
        $this->delete($table, "child='Zone.LoadChildByAjax'");


        $table = "rights";
        $this->delete($table, "itemname='Zone.*'");
        $this->delete($table, "itemname='Zone.Create'");
        $this->delete($table, "itemname='Zone.Update'");
        $this->delete($table, "itemname='Zone.Delete'");
        $this->delete($table, "itemname='Zone.Index'");
        $this->delete($table, "itemname='Zone.View'");


        $this->delete($table, "itemname='Zone.DeleteChildByAjax'");
        $this->delete($table, "itemname='Zone.EditChild'");
        $this->delete($table, "itemname='Zone.LoadChildByAjax'");
    }

}