<?php

class m131209_093801_CityAdminRightsforShipping extends DTDbMigration {

    public function up() {
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "ShippingClass.*",
        );
        $this->insert($table, $columns);

        $table = "authitem";
        $columns = array(
            "name" => "ShippingClass.ToggleEnabled",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        
        $this->insert($table, $columns);

        $table = "authitemchild";
        $columns = array(
            "parent" => "ShippingClass.Update",
            "child" => "ShippingClass.ToggleEnabled",
        );
        $this->insert($table, $columns);


        $table = "rights";
        $columns = array(
            "itemname" => "ShippingClass.ToggleEnabled",
            "type" => "0",
        );
        
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='ShippingClass.*'");
         
        
        $table = "authitem";
        $this->delete($table, "name = 'ShippingClass.ToggleEnabled'");
        
        $table = "authitemchild";
        $this->delete($table, "child = 'ShippingClass.ToggleEnabled'");
        
        
        $table = "rights";
        $this->delete($table, "itemname = 'ShippingClass.ToggleEnabled'");
    }

}