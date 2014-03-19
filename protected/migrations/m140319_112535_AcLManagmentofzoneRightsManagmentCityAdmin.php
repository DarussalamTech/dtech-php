<?php

class m140319_112535_AcLManagmentofzoneRightsManagmentCityAdmin extends DTDbMigration {

    public function up() {
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "Zone.*",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='Zone.*'");
    }

}