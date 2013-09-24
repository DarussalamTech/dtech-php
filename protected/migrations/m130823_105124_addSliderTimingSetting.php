<?php

class m130823_105124_addSliderTimingSetting extends DTDbMigration {

    public function up() {
        $table = "conf_misc";


        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {


            /* * **** face book ** */
            $columns = array(
                "title" => "Slider Time",
                "param" => "slider_time",
                "value" => "",
                "field_type" => "text",
                "site_id" => "1",
                "misc_type" =>"other",
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
            $this->delete($table, "param='slider_time' AND city_id='" . $row['city_id'] . "'");
            
        }
    }

}