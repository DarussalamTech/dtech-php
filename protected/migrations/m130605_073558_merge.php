<?php

class m130605_073558_merge extends DTDbMigration {

    public function up() {
        $table = "categories";

        $sql = "SELECT * FROM city 
                 ";

        $cities = $this->getQueryAll($sql);
        foreach ($cities as $city) {
            $columns = array(
                'category_name' => 'Books',
                'added_date' => time(),
                'parent_id' => '0',
                'city_id' => $city['city_id'],
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
                "activity_log" => "inserted by Admin",
            );

            $this->insert($table, $columns);

            $columns = array(
                'category_name' => 'Educational Toys',
                'added_date' => time(),
                'parent_id' => '0',
                'city_id' => $city['city_id'],
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
                "activity_log" => "inserted by Admin",
            );

            $this->insert($table, $columns);

            $columns = array(
                'category_name' => 'Others',
                'added_date' => time(),
                'parent_id' => '0',
                'city_id' => $city['city_id'],
                "create_time" => date("Y-m-d H:i:s"),
                "create_user_id" => 1,
                "update_time" => date("Y-m-d H:i:s"),
                "update_user_id" => 1,
                "activity_log" => "inserted by Admin",
            );

            $this->insert($table, $columns);
        }
    }

    public function down() {
        $table = "categories";

        $sql = "SELECT * FROM city 
                 ";

        $cities = $this->getQueryAll($sql);
        foreach ($cities as $city) {


            $this->delete($table, "city_id = '" . $city['city_id'] . "' AND category_name ='Books'");



            $this->delete($table, "city_id = '" . $city['city_id'] . "' AND category_name ='Educational Toys'");



            $this->delete($table, "city_id = '" . $city['city_id'] . "' AND category_name ='Others'");
        }
    }

}