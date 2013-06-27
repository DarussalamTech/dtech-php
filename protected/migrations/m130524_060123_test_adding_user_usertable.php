<?php

/*
 * Migration for insterting test user in user table 
 */

class m130524_060123_test_adding_user_usertable extends CDbMigration {

    public function up() {

        $table = "user";
        for ($i = 1; $i < 200; $i++) {
            $columns = array(
                "user_name" => 'testuser' . $i,
                "user_password" => md5('admin'),
                "user_email" => 'test' . $i . '@gmail.com',
                "role_id" => '3',
                "status_id" => "1",
                "city_id" => "1",
                "site_id" => "1",
            );
            $this->insert($table, $columns);
        }
    }

    public function down() {
        $table = "user";
        for ($i = 1; $i < 200; $i++) {
            $columns = array(
                "user_name" => 'testuser' . $i,
                "user_password" => md5('admin'),
                "user_email" => 'test' . $i . '@gmail.com',
                "role_id" => '3',
                "status_id" => "1",
                "city_id" => "1",
                "site_id" => "1",
            );
            $this->delete($table, 'user_name="testuser' . $i . '"');
        }
    }

}