<?php

class m130507_055947_add_data_to_static extends CDbMigration {

    public function up() {
        $table = "pages";

        $this->truncateTable($table);
        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {


            /*             * **** static pages book ** */
            $columns = array(
                "city_id" => $row['city_id'],
                "title" => "About Us",
                "content" => "",
            );
            
            $this->insert($table, $columns);
            $columns = array(
                "city_id" => $row['city_id'],
                "title" => "Contact Us",
                "content" => "",
            );
            
            $this->insert($table, $columns);
            $columns = array(
                "city_id" => $row['city_id'],
                "title" => "Help",
                "content" => "",
            );

            $this->insert($table, $columns);
            $columns = array(
                "city_id" => $row['city_id'],
                "title" => "FAQ's",
                "content" => "",
            );
            $this->insert($table, $columns);
            
            $columns = array(
                "city_id" => $row['city_id'],
                "title" => "Terms & Conditions",
                "content" => "",
            );
            $this->insert($table, $columns);
            $columns = array(
                "city_id" => $row['city_id'],
                "title" => "Shipping Rates & Policies",
                "content" => "",
            );
            $this->insert($table, $columns);
        }
    }

    public function down() {
        $table = "pages";


        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {
            /**             * *********** City based deletions ******************** */
            $this->delete($table, "city_id='" . $row['city_id'] . "'");
        }
    }

}