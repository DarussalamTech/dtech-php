<?php

class m130626_055740_add_currency_to_city_table extends DTDbMigration {

    public function up() {
        $table = "country";
        $contries = $this->findAllRecords($table, array("country_id", "country_name"), 'country_id', 'country_name', "");

        // for All cities of Pakistan CURRENCY id = 1 
        foreach ($contries as $id => $name) {
            if ($name == "Pakistan") {
                $table = 'city';
                $sql = "SELECT city_id,city_name,country_id 
                FROM city 
                WHERE country_id=$id";
                $cities = $this->getQueryAll($sql);

                foreach ($cities as $city_id => $city_name) {
                    $columns = array(
                        'currency_id' => 1,
                    );

                    $this->update('city', $columns, 'city_id=' . $city_name['city_id']);
                }
            }

            // for All cities of Saudi Arabia CURRENCY id = 2 

            if ($name == "Saudi Arabia") {
                $table = 'city';
                $sql = "SELECT city_id,city_name,country_id 
                FROM city 
                WHERE country_id=$id";
                $cities = $this->getQueryAll($sql);

                foreach ($cities as $city_id => $city_name) {
                    $columns = array(
                        'currency_id' => 2, // id 2 for Saudi Arabia Rial Currency
                    );

                    $this->update('city', $columns, 'city_id=' . $city_name['city_id']);
                }
            }


            // for All cities of United Kingdom Pound CURRENCY id = 3 

            if ($name == "United Kingdom") {
                $table = 'city';
                $sql = "SELECT city_id,city_name,country_id 
                FROM city 
                WHERE country_id=$id";
                $cities = $this->getQueryAll($sql);

                foreach ($cities as $city_id => $city_name) {
                    $columns = array(
                        'currency_id' => 3,
                    );

                    $this->update('city', $columns, 'city_id=' . $city_name['city_id']);
                }
            }
            // for All cities of United States Dollar CURRENCY id = 3 

            if ($name == "United States") {
                $table = 'city';
                $sql = "SELECT city_id,city_name,country_id 
                FROM city 
                WHERE country_id=$id";
                $cities = $this->getQueryAll($sql);

                foreach ($cities as $city_id => $city_name) {
                    $columns = array(
                        'currency_id' => 4,
                    );

                    $this->update('city', $columns, 'city_id=' . $city_name['city_id']);
                }
            }
        }
    }

    public function down() {
        $columns = array(
            'currency_id' => 0,
        );
        $this->update('city', $columns);
    }

}