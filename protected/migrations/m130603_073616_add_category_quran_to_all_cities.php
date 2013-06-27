<?php

class m130603_073616_add_category_quran_to_all_cities extends DTDbMigration {

    public function up() {
        $table = 'categories';
        $sql = "SELECT * FROM city 
                WHERE city_id !=1";

        $cities = $this->getQueryAll($sql);
        foreach ($cities as $city) {
            $columns = array(
                'category_name' => 'Quran',
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
        $table = 'categories';
        $this->delete($table, "category_name='Quran' AND city_id !=1");
        return TRUE;
    }

}