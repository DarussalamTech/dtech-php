<?php

class m130704_062616_add_data_to_paymentMethod extends DTDbMigration {

    public function up() {
        $table = 'payment_methods';

        $this->truncateTable($table);

        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {


            /*             * **** face book ** */
            $columns = array(
                "secret" => "Null",
                "signature" => "Null",
                "name" => "Pay Pal",
                "city_id" => $row['city_id'],
                "status" => "Disable",
                "sandbox" => "Enable",
            );
            $this->insertRow($table, $columns);
            /*             * **** face book ** */
            $columns = array(
                "secret" => "Null",
                "signature" => "Null",
                "name" => "Credit Card",
                "city_id" => $row['city_id'],
                "status" => "Disable",
                "sandbox" => "Enable",
            );
            $this->insertRow($table, $columns);
            /*             * **** face book ** */
            $columns = array(
                "secret" => "Null",
                "signature" => "Null",
                "name" => "Cash On Delievery",
                "city_id" => $row['city_id'],
                "status" => "Disable",
                "sandbox" => "Enable",
            );
            $this->insertRow($table, $columns);
        }
    }

    public function down() {
        $table = 'payment_methods';
        $connection = Yii::app()->db;
        $sql = "SELECT city_id,city_name from city";
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $row) {
            /**             * *********** LinkedIn ******************** */
            $this->delete($table, "name='Pay Pal' AND city_id='" . $row['city_id'] . "'");
            $this->delete($table, "name='Credit Card' AND city_id='" . $row['city_id'] . "'");
            $this->delete($table, "name='Cash On Delievery' AND city_id='" . $row['city_id'] . "'");
        }
    }

}