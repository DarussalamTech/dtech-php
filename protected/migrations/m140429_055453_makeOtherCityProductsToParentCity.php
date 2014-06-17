<?php

class m140429_055453_makeOtherCityProductsToParentCity extends DTDbMigration {

    public function up() {
        $super_city = $this->getSuperCityId();
        $products = $this->getQueryAll("SELECT product_id,universal_name FROM product WHERE city_id = " . $super_city[0]);
        foreach ($products as $product) {
            $universal_name = $product['universal_name'];
            $sql = 'Select t.product_id,universal_name,city_id,product_name FROM product t ';
            
            $sql.= " INNER JOIN product_profile ON product_profile.product_id = t.product_id ";
            $sql.= ' WHERE universal_name = "' . $universal_name . '"';
            $sql.= " AND city_id <> ".$super_city[0];
            $data = $this->getQueryAll($sql);
            foreach($data as $cityProd){
                $this->update("product", array("parent_id"=>$product['product_id']),"product_id = ".$cityProd['product_id']);
            }
        }
        
    }

    public function down() {
        return true;
    }

}