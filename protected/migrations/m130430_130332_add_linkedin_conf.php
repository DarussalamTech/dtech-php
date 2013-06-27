<?php

class m130430_130332_add_linkedin_conf extends CDbMigration {

    public function up() {
        $table = "conf_misc";


        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {


            /*             * **** face book ** */
            $columns = array(
                "title" => "LinkedIn Key",
                "param" => "linkedin_key",
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
                "title" => "LinkedIn Secret",
                "param" => "linkedin_secret",
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
            /**             * *********** LinkedIn ******************** */
            $this->delete($table, "param='linkedin_key' AND city_id='" . $row['city_id'] . "'");
            $this->delete($table, "param='linkedin_secret' AND city_id='" . $row['city_id'] . "'");
        }
    }

}