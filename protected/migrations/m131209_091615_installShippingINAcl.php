<?php

class m131209_091615_installShippingINAcl extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.*",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
         //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.Create",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.Update",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.Index",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.Delete",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);
        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.View",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);

        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.*",
            "child" => "ShippingClass.Create",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.*",
            "child" => "ShippingClass.Update",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.*",
            "child" => "ShippingClass.Delete",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.Create",
            "child" => "ShippingClass.Index",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.Update",
            "child" => "ShippingClass.Index",
        );
        $this->insert($table, $columns);
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.Delete",
            "child" => "ShippingClass.Index",
        );
        $this->insert($table, $columns);
        
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.Index",
            "child" => "ShippingClass.View",
        );
        $this->insert($table, $columns);

        //--------Rights-----
        
         $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.*",
            "type" => "0",

        );
        $this->insert($table, $columns);
         //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.Create",
            "type" => "0",

        );
        $this->insert($table, $columns);

        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.Update",
            "type" => "0",

        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.Index",
            "type" => "0",

        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.Delete",
            "type" => "0",

        );
        $this->insert($table, $columns);
        //-------------
        $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.View",
            "type" => "0",

        );
        $this->insert($table, $columns);

       
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='ShippingClass.*'");
        $this->delete($table, "name='ShippingClass.Create'");
        $this->delete($table, "name='ShippingClass.Update'");
        $this->delete($table, "name='ShippingClass.Delete'");
        $this->delete($table, "name='ShippingClass.Index'");
        $this->delete($table, "name='ShippingClass.View'");
     
     
        $table = "authitemchild";
        $this->delete($table, "child='ShippingClass.Create'");
        $this->delete($table, "child='ShippingClass.Update'");
        $this->delete($table, "child='ShippingClass.Delete'");
        $this->delete($table, "child='ShippingClass.Index'");
        $this->delete($table, "child='ShippingClass.View'");
        

        $table = "rights";
        $this->delete($table, "itemname='ShippingClass.*'");
        $this->delete($table, "itemname='ShippingClass.Create'");
        $this->delete($table, "itemname='ShippingClass.Update'");
        $this->delete($table, "itemname='ShippingClass.Delete'");
        $this->delete($table, "itemname='ShippingClass.Index'");
        $this->delete($table, "itemname='ShippingClass.View'");
    }

}