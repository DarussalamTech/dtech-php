<?php

class m140425_071541_assigningCityAdminNotifications extends DTDbMigration {

    public function up() {
        //-------------
        $table = "authitemchild";
        $columns = array(
            "parent" => "CityAdmin",
            "child" => "Notifcation.*",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitemchild";
        $this->delete($table, "parent='CityAdmin' AND child ='Notifcation.*'");
    }

}