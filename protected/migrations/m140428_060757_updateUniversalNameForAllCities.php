<?php

class m140428_060757_updateUniversalNameForAllCities extends DTDbMigration {

    public function up() {
        $table = "product";

        $cities = $this->getQueryAll("SELECT DISTINCT(city_id) FROM " . $table);
        $products = $this->getQueryAll(" SELECT * FROM " . $table . " WHERE city_id = " . $cities[0]['city_id']);
        $not_names = array();
        foreach ($products as $product) {

            if (isset($cities[1]['city_id'])) {

                $lower_prod = strtolower(trim($product['product_name']));
                $sql = 'Select * FROM ' . $table . ' WHERE Lower(product_name) = "' . $lower_prod . '"';

                $sql.= " AND city_id = " . $cities[1]['city_id'];
                $product_other_city = $this->getQueryRow($sql);
                if (empty($product_other_city)) {
                    $not_names[] = trim($product['product_name']);
                } else if (!empty($product_other_city)) {
                    $this->update($table, array("universal_name" => $lower_prod), "product_id = " . $product_other_city['product_id']);
                }
            }

            $this->update($table, array("universal_name" => $lower_prod), "product_id = " . $product['product_id']);
        }

        if (isset($cities[1]['city_id'])) {
            $not_names = '"' . implode('","', $not_names) . '"';
            $sql = "SELECT * FROM " . $table . " WHERE product_name NOT IN ($not_names) ";
            $sql.= " AND city_id = " . $cities[1]['city_id'];
            $not_saudia = $this->getQueryAll($sql);
            foreach ($not_saudia as $product) {
                $lower_prod = strtolower(trim($product['product_name']));
                $this->update($table, array("universal_name" => $lower_prod), "product_id = " . $product['product_id']);
            }
        }
        
    }

    public function down() {
        $table = "product";
        return true;
    }

}