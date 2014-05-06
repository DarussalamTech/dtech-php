<?php

class m140506_073043_productTemplateAclforCityAdmin2 extends DTDbMigration {

    public function up() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='ProductTemplate.*'");

        //adding only that needed
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "ProductTemplate.Index",
        );
        $this->insert($table, $columns);

        //adding only that needed
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "ProductTemplate.MakeAvailable",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='ProductTemplate.Index'");
        $this->delete($table, "parent='CityAdmin' AND child ='ProductTemplate.MakeAvailable'");
    }

}