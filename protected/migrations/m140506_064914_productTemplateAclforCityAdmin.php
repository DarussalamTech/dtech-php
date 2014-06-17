<?php

class m140506_064914_productTemplateAclforCityAdmin extends DTDbMigration {

    public function up() {
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "ProductTemplate.*",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='ProductTemplate.*'");
    }

}