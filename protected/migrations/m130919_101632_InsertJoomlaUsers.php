<?php

class m130919_101632_InsertJoomlaUsers extends DTDbMigration {

    public function up() {
        $table = "joomla_users";
        $allRecords = $this->getQueryAll("SELECT id,name,username,email FROM joomla_users WHERE usertype ='Registered'");


        //print_r($allRecords);
        $table = "user";
        $all_usernames = $this->findAllRecords($table, array("user_name"), "user_name", "user_name");
        $all_useremails = $this->findAllRecords($table, array("user_email"), "user_email", "user_email");

        foreach ($allRecords as $data) {
            $columns = array(
                "user_name" => $data['username'],
                "user_email" => $data['email'],
                "source" => "outside",
                "role_id" => "3",
                "site_id" => "1",
                "status_id" => "2",
            );

            if (!in_array($data['username'], $all_usernames) && !in_array($data['email'], $all_useremails)) {
                $this->insertRow($table, $columns);
            }
        }
    }

    public function down() {
        $table = "joomla_users";
        $this->delete($table, 'source="outside"');
    }

}