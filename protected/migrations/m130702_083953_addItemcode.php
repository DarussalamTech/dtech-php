<?php

class m130702_083953_addItemcode extends DTDbMigration {

    public function up() {
        $table = "conf_misc";

        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {

            $columns = array(
                "title" => "Auto Generated Item Code",
                "param" => "auto_item_code",
                "field_type" => "dropDown",
                "site_id" => "1",
                "misc_type" => "other",
                "city_id" => $row['city_id'],
  
            );
            
          

            $this->insertRow($table, $columns);
        }
        
    }

    public function down() {
        $table = "conf_misc";

        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {
            $this->delete($table, "param='auto_item_code' AND city_id='" . $row['city_id'] . "'");
        }
    }

}