<?php

class m140617_095404_addInsertDashboardToAcl extends DTDbMigration {

    public function up() {
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "DashBoard.*",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='DashBoard.*'");
    }

}