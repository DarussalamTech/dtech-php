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

        //Notification view

        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.MoveTo",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //Notification view

        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.MarkStatus",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //Notification 
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.ManageFolders",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //Notification view

        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.DeleteFolder",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        /********************************************************/
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
            "child" => "Notifcation.ManageFolders",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.Index",
            "child" => "Notifcation.DeleteFolder",
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
            "itemname" => "Notifcation.Create",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.Copy",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.Index",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.Delete",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.View",
            "type" => "0",
        );
        $this->insert($table, $columns);


        //view history
        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.CreateFolder",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //three other child data insertion updating deleion actions

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.MoveTo",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.MarkStatus",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.DeletedItems",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.DeletedItems",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.ManageFolders",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.DeleteFolder",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Notifcation.*'");
        $this->delete($table, "name='Notifcation.Create'");
        $this->delete($table, "name='Notifcation.Copy'");
        $this->delete($table, "name='Notifcation.Delete'");
        $this->delete($table, "name='Notifcation.Index'");
        $this->delete($table, "name='Notifcation.View'");
        
        $this->delete($table, "name='Notifcation.DeletedItems'");
        $this->delete($table, "name='Notifcation.ManageFolders'");
        $this->delete($table, "name='Notifcation.DeleteFolder'");
        $this->delete($table, "name='Notifcation.MoveTo'");
        $this->delete($table, "name='Notifcation.MarkStatus'");
        $this->delete($table, "name='Notifcation.CreateFolder'");
      


        $table = "authitemchild";
        $this->delete($table, "child='Notifcation.Create'");
        $this->delete($table, "child='Notifcation.Copy'");
        $this->delete($table, "child='Notifcation.Delete'");
        $this->delete($table, "child='Notifcation.Index'");
        $this->delete($table, "child='Notifcation.View'");

        $this->delete($table, "child='Notifcation.DeletedItems'");
        $this->delete($table, "child='Notifcation.ManageFolders'");
        $this->delete($table, "child='Notifcation.DeleteFolder'");
        $this->delete($table, "child='Notifcation.MoveTo'");
        $this->delete($table, "child='Notifcation.MarkStatus'");
        $this->delete($table, "child='Notifcation.CreateFolder'");


        $table = "rights";
        $this->delete($table, "itemname='Notifcation.*'");
        $this->delete($table, "itemname='Notifcation.Create'");
        $this->delete($table, "itemname='Notifcation.Copy'");
        $this->delete($table, "itemname='Notifcation.Delete'");
        $this->delete($table, "itemname='Notifcation.Index'");
        $this->delete($table, "itemname='Notifcation.View'");


        $this->delete($table, "itemname='Notifcation.DeletedItems'");
        $this->delete($table, "itemname='Notifcation.ManageFolders'");
        $this->delete($table, "itemname='Notifcation.DeleteFolder'");
        $this->delete($table, "itemname='Notifcation.MoveTo'");
        $this->delete($table, "itemname='Notifcation.MarkStatus'");
        $this->delete($table, "itemname='Notifcation.CreateFolder'");
    }

}