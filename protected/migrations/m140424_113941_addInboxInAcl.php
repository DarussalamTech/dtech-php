<?php

/**
 * related to acl
 */
class m140424_113941_addInboxInAcl extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.*",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.Create",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.Copy",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.Index",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.DeletedItems",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.Delete",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.View",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //view history
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.CreateFolder",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //zone view

        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.MoveTo",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //zone view

        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.MarkStatus",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.*",
            "child" => "Notifcation.Create",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.*",
            "child" => "Notifcation.Copy",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.*",
            "child" => "Notifcation.Delete",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Create",
            "child" => "Notifcation.Index",
        );
        $this->insert($table, $columns);
        
        
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Create",
            "child" => "Notifcation.MarkStatus",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Copy",
            "child" => "Notifcation.Index",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Copy",
            "child" => "Notifcation.MarkStatus",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Delete",
            "child" => "Notifcation.Index",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Delete",
            "child" => "Notifcation.MarkStatus",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Index",
            "child" => "Notifcation.View",
        );
        $this->insert($table, $columns);
        
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Index",
            "child" => "Notifcation.CreateFolder",
        );
        $this->insert($table, $columns);
        
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Index",
            "child" => "Notifcation.MoveTo",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Index",
            "child" => "Notifcation.DeletedItems",
        );
        $this->insert($table, $columns);

        //view history
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Index",
            "child" => "Notifcation.View",
        );
        $this->insert($table, $columns);

        //--------Rights-----

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.*",
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


        //view history
        $table = "rights";
        $columns = array(
            "itemname" => "Zone.ViewHistory",
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