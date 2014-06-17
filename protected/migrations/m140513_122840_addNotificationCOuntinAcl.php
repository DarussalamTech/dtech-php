<?php

class m140513_122840_addNotificationCOuntinAcl extends DTDbMigration {

    public function up() {
        $table = "authitem";
        $columns = array(
            "name" => "Notifcation.GetTotalNotifications",
            "type" => "0",
            "bizrule" => "",
            "data" => "N;",
        );
        $this->insert($table, $columns);


        $table = "authitemchild";
        $columns = array(
            "parent" => "Notifcation.View",
            "child" => "Notifcation.GetTotalNotifications",
        );
        $this->insert($table, $columns);

        $table = "rights";
        $columns = array(
            "itemname" => "Notifcation.GetTotalNotifications",
            "type" => "0",
        );
        $this->insert($table, $columns);
    }

    public function down() {
        $table = "authitem";
        $this->delete($table, "name='Notifcation.GetTotalNotifications'");

        $table = "authitemchild";
        $this->delete($table, "child='Notifcation.GetTotalNotifications'");

        $table = "rights";
        $this->delete($table, "itemname='Notifcation.GetTotalNotifications'");
    }

}