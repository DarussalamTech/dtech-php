<?php

class m140506_051034_makeAclRegardingWebProductTemplate extends DTDbMigration {

    public function up() {

        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.*",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.Create",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.Update",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.Index",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.Delete",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.View",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //view history
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.ViewImage",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //ProductTemplate view

        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.ViewProduct",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //ProductTemplate view

        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.MakeAvailable",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //ProductTemplate 
        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.LoadChildByAjax",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //ProductTemplate view

        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.EditChild",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //ProductTemplate deleteChildByAjax

        $table = "authitem";
        $columns = array(
            "name" => "ProductTemplate.deleteChildByAjax",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        /*         * ************************************************************** */
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.*",
            "child" => "ProductTemplate.Create",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.*",
            "child" => "ProductTemplate.Update",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.*",
            "child" => "ProductTemplate.Delete",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Create",
            "child" => "ProductTemplate.Index",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Create",
            "child" => "ProductTemplate.MakeAvailable",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Create",
            "child" => "ProductTemplate.LoadChildByAjax",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Update",
            "child" => "ProductTemplate.MakeAvailable",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Update",
            "child" => "ProductTemplate.EditChild",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Delete",
            "child" => "ProductTemplate.Index",
        );
        $this->insert($table, $columns);


        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Delete",
            "child" => "ProductTemplate.DeleteChildByAjax",
        );
        $this->insert($table, $columns);



        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.Index",
            "child" => "ProductTemplate.View",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.View",
            "child" => "ProductTemplate.ViewImage",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ProductTemplate.View",
            "child" => "ProductTemplate.ViewProduct",
        );
        $this->insert($table, $columns);



        //--------Rights-----

        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.*",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.Create",
            "type" => "0",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.Update",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.Index",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.Delete",
            "type" => "0",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.View",
            "type" => "0",
        );
        $this->insert($table, $columns);


     

        //three other child data insertion updating deleion actions

        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.ViewImage",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.ViewProduct",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.MakeAvailable",
            "type" => "0",
        );
        $this->insert($table, $columns);


        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.LoadChildByAjax",
            "type" => "0",
        );
        $this->insert($table, $columns);
        
        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.EditChild",
            "type" => "0",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "ProductTemplate.DeleteChildByAjax",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='ProductTemplate.*'");
        $this->delete($table, "name='ProductTemplate.Create'");
        $this->delete($table, "name='ProductTemplate.Update'");
        $this->delete($table, "name='ProductTemplate.Delete'");
        $this->delete($table, "name='ProductTemplate.Index'");
        $this->delete($table, "name='ProductTemplate.View'");

        $this->delete($table, "name='ProductTemplate.ViewImage'");
        $this->delete($table, "name='ProductTemplate.ViewProduct'");
        $this->delete($table, "name='ProductTemplate.MakeAvailable'");
        $this->delete($table, "name='ProductTemplate.LoadChildByAjax'");
        $this->delete($table, "name='ProductTemplate.EditChild'");
        $this->delete($table, "name='ProductTemplate.DeleteChildByAjax'");



        $table = "authitemchild";
        $this->delete($table, "child='ProductTemplate.Create'");
        $this->delete($table, "child='ProductTemplate.Update'");
        $this->delete($table, "child='ProductTemplate.Delete'");
        $this->delete($table, "child='ProductTemplate.Index'");
        $this->delete($table, "child='ProductTemplate.View'");

        $this->delete($table, "child='ProductTemplate.ViewImage'");
        $this->delete($table, "child='ProductTemplate.ViewProduct'");
        $this->delete($table, "child='ProductTemplate.MakeAvailable'");
        $this->delete($table, "child='ProductTemplate.LoadChildByAjax'");
        $this->delete($table, "child='ProductTemplate.EditChild'");
        $this->delete($table, "child='ProductTemplate.DeleteChildByAjax'");


        $table = "rights";
        $this->delete($table, "itemname='ProductTemplate.*'");
        $this->delete($table, "itemname='ProductTemplate.Create'");
        $this->delete($table, "itemname='ProductTemplate.Update'");
        $this->delete($table, "itemname='ProductTemplate.Delete'");
        $this->delete($table, "itemname='ProductTemplate.Index'");
        $this->delete($table, "itemname='ProductTemplate.View'");


        $this->delete($table, "itemname='ProductTemplate.ViewImage'");
        $this->delete($table, "itemname='ProductTemplate.ViewProduct'");
        $this->delete($table, "itemname='ProductTemplate.MakeAvailable'");
        $this->delete($table, "itemname='ProductTemplate.LoadChildByAjax'");
        $this->delete($table, "itemname='ProductTemplate.EditChild'");
        $this->delete($table, "itemname='ProductTemplate.DeleteChildByAjax'");
    }

}