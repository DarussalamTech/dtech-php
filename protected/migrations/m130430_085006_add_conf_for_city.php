<?php

class m130430_085006_add_conf_for_city extends DTDbMigration {

    public function up() {
        $table = "conf_misc";


        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {

            $columns = array(
                "title" => "Date Format",
                "param" => "dateformat",
                "value" => "y/m/d",
                "field_type" => "dropDown",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            $columns = array(
                "title" => "Smtp Email",
                "param" => "smtp",
                "value" => "y/m/d",
                "field_type" => "dropDown",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            /*             * ***** face book ** */
            $columns = array(
                "title" => "Facebook Key",
                "param" => "fb_key",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            $columns = array(
                "title" => "Facebook Secret",
                "param" => "fb_secret",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            /*             * ***** Google ** */
            $columns = array(
                "title" => "Google Key",
                "param" => "google_key",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            $columns = array(
                "title" => "Google Secret",
                "param" => "google_secret",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            /*             * ***** Twitter ** */
            $columns = array(
                "title" => "Twitter Key",
                "param" => "twitter_key",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);

            $columns = array(
                "title" => "Twitter Secret",
                "param" => "twitter_secret",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "city_id" => $row['city_id'],
                "create_time" => date("Y-m-d h:m:s"),
                "create_user_id" => "1",
                "update_time" => date("Y-m-d h:m:s"),
                "update_user_id" => "1",
            );

            $this->insert($table, $columns);
        }
    }

    public function down() {
        $table = "conf_misc";


        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {

            $this->delete($table, "param='dateformat' AND city_id='" . $row['city_id'] . "'");

            $this->delete($table, "param='smtp' AND city_id='" . $row['city_id'] . "'");

            /*             * ***** face book ** */


            $this->delete($table, "param='fb_key' AND city_id='" . $row['city_id'] . "'");



            $this->delete($table, "param='fb_secret' AND city_id='" . $row['city_id'] . "'");

            /*             * ***** Google ** */


            $this->delete($table, "param='google_key' AND city_id='" . $row['city_id'] . "'");


            $this->delete($table, "param='google_secret' AND city_id='" . $row['city_id'] . "'");

            /*             * ***** Twitter ** */


            $this->delete($table, "param='twitter_key' AND city_id='" . $row['city_id'] . "'");


            $this->delete($table, "param='twitter_secret' AND city_id='" . $row['city_id'] . "'");
        }
    }

}